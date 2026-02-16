#include <complex>
#include <iostream>
#include <map>

#include "php.h"
#include "zend_exceptions.h"
#include <SFML/Window.hpp>

#include "../util.hpp"
#include "event.hpp"


#include <cxxabi.h>
static std::string demangle_type_name(const char* mangled) {
    int status = 0;
    char* demangled = abi::__cxa_demangle(mangled, nullptr, nullptr, &status);
    std::string out = (status == 0 && demangled) ? demangled : mangled;
    std::free(demangled);
    return out;
}

static std::string pretty_type_name(const std::type_info& ti) {
    return demangle_type_name(ti.name());
}

extern "C" {
    ZEND_DLEXPORT void windowbase_construct(zend_execute_data *execute_data, zval *return_value) {
        zval* mode_php;
        char* title_c;
        std::size_t title_len;
        zval* window_style_arr = nullptr;
        zval* state_php = nullptr;

        zend_parse_parameters(ZEND_NUM_ARGS(), "os|aoo", &mode_php, &title_c, &title_len, &window_style_arr, &state_php);
        auto* mode = storage_get<sf::VideoMode>(mode_php);
        std::string title(title_c, title_len);
        std::uint32_t window_style = sf::Style::Default;
        if (window_style_arr != nullptr) {
            HashTable* arr_hash = Z_ARRVAL_P(window_style_arr);
            zval* val;
            window_style = 0;
            ZEND_HASH_FOREACH_VAL(arr_hash, val) {
                zval value;
                zval* x = zend_read_property(nullptr, Z_OBJ_P(val), ZEND_STRL("value"), false, &value);
                window_style |= 1 << Z_LVAL_P(x);
            } ZEND_HASH_FOREACH_END();
        }
        sf::State state = sf::State::Windowed;
        if (state_php != nullptr) {
            zval value;
            zval* x = zend_read_property(nullptr, Z_OBJ_P(state_php), ZEND_STRL("value"), false, &value);
            state = static_cast<sf::State>(Z_LVAL_P(x));
        }
        storage_put(execute_data, new sf::WindowBase(*mode, title, window_style, state));
    }
    ZEND_DLEXPORT void windowbase_destruct(zend_execute_data *execute_data, zval *return_value) {
        storage_remove<sf::WindowBase>(execute_data);
    }
    ZEND_DLEXPORT void windowbase_fromhandle(zend_execute_data *execute_data, zval *return_value) {
        zval* obj;
        zend_parse_parameters(ZEND_NUM_ARGS(), "o", &obj);
        // TODO validate that object has a valid handle
        auto* handle = storage_get<sf::WindowHandle>(obj);
        if (handle == nullptr) {
            zend_throw_exception(nullptr, "Object does not have a valid window handle", 0);
            return;
        }
        storage_new(return_value, R"(iggyvolz\SFML\System\WindowBase)", new sf::WindowBase(*handle));
    }
    ZEND_DLEXPORT void windowbase_close(zend_execute_data *execute_data, zval *return_value) {
        storage_get<sf::WindowBase>(execute_data)->close();
    }
    ZEND_DLEXPORT void windowbase_isopen(zend_execute_data *execute_data, zval *return_value) {
        RETURN_BOOL(storage_get<sf::WindowBase>(execute_data)->isOpen());
    }
    ZEND_DLEXPORT void windowbase_pollevent(zend_execute_data *execute_data, zval *return_value) {
        auto event_ = storage_get<sf::WindowBase>(execute_data)->pollEvent();
        if (!event_.has_value()) RETURN_NULL();
        auto event = event_.value();
        auto print_variant_type = [](auto&& value) {
            using T = std::decay_t<decltype(value)>;
            std::cout << "got a " << pretty_type_name(typeid(T)) << std::endl;
        };
        event.visit(print_variant_type);
        RETURN_EVENTS();
    }
    ZEND_DLEXPORT void windowbase_waitevent(zend_execute_data *execute_data, zval *return_value) {
        zval time_obj;
        ZVAL_NULL(&time_obj);
        zend_parse_parameters(ZEND_NUM_ARGS(), "|o", &time_obj);
        const sf::Time* time = ZVAL_IS_NULL(&time_obj) ? &sf::Time::Zero : storage_get<sf::Time>(time_obj);
        auto event_ = storage_get<sf::WindowBase>(execute_data)->waitEvent(*time);
        if (!event_.has_value()) RETURN_NULL();
        auto event = event_.value();
        RETURN_EVENTS();
        RETURN_NULL();
    }
}