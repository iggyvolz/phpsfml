#include <complex>
#include <iostream>
#include <map>

#include "php.h"
#include "zend_exceptions.h"
#include <SFML/Window.hpp>

#include "../util.hpp"
#include "event.hpp"

#define SPEM_DEBUG 0

#if SPEM_DEBUG
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
#endif

extern "C" {
    ZEND_DLEXPORT void windowbase_construct(zend_execute_data *execute_data, zval *return_value) {
        zval* mode_php;
        zend_class_entry* videomode_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\VideoMode"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        zend_string* title_php;
        zval* window_style_arr = nullptr;
        zval* state_php = nullptr;
        zend_class_entry* state_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\State"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);

        if(zend_parse_parameters(ZEND_NUM_ARGS(), "OS|aO", &mode_php, videomode_ce, &title_php, &window_style_arr, &state_php, state_ce) != SUCCESS) return;
        auto mode = *storage_get<sf::VideoMode>(mode_php);
        sf::String title = sf::String::fromUtf8(title_php->val, title_php->val + title_php->len);
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
        auto state = sf::State::Windowed;
        if (state_php != nullptr) {
            zval value;
            zval* x = zend_read_property(nullptr, Z_OBJ_P(state_php), ZEND_STRL("value"), false, &value);
            state = static_cast<sf::State>(Z_LVAL_P(x));
        }
        storage_put(execute_data, new sf::WindowBase(mode, title, window_style, state));
    }
    ZEND_DLEXPORT void windowbase_destruct(zend_execute_data *execute_data, zval *return_value) {
        storage_remove<sf::WindowBase>(execute_data);
    }
    ZEND_DLEXPORT void windowbase_fromhandle(zend_execute_data *execute_data, zval *return_value) {
        zval* obj;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "o", &obj) != SUCCESS) return;
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
#if SPEM_DEBUG
        auto print_variant_type = [](auto&& value) {
            using T = std::decay_t<decltype(value)>;
            std::cout << "got a " << pretty_type_name(typeid(T)) << std::endl;
        };
        event.visit(print_variant_type);
#endif
        RETURN_EVENTS();
    }
    ZEND_DLEXPORT void windowbase_waitevent(zend_execute_data *execute_data, zval *return_value) {
        zval time_obj;
        ZVAL_NULL(&time_obj);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "|o", &time_obj) != SUCCESS) return;
        const sf::Time* time = ZVAL_IS_NULL(&time_obj) ? &sf::Time::Zero : storage_get<sf::Time>(time_obj);
        auto event_ = storage_get<sf::WindowBase>(execute_data)->waitEvent(*time);
        if (!event_.has_value()) RETURN_NULL();
        auto event = event_.value();
        RETURN_EVENTS();
        RETURN_NULL();
    }
    ZEND_DLEXPORT void windowbase_getsize(zend_execute_data *execute_data, zval *return_value) {
        auto size = storage_get<sf::WindowBase>(execute_data)->getSize();
        array_init(return_value);
        add_next_index_long(return_value, size.x);
        add_next_index_long(return_value, size.y);
    }
    ZEND_DLEXPORT void windowbase_setsize(zend_execute_data *execute_data, zval *return_value) {
        zval* size;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "a", &size) != SUCCESS) return;
        zend_long x = Z_LVAL_P(zend_hash_index_find(Z_ARRVAL_P(size), 0));
        zend_long y = Z_LVAL_P(zend_hash_index_find(Z_ARRVAL_P(size), 1));
        storage_get<sf::WindowBase>(execute_data)->setSize(sf::Vector2u(x, y));
    }
    ZEND_DLEXPORT void windowbase_setIcon(zend_execute_data *execute_data, zval *return_value) {
        zend_long width, height;
        zend_string* pixels;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "llS", &width, &height, &pixels) != SUCCESS) return;
        ZEND_ASSERT(pixels->len == width * height);
        storage_get<sf::WindowBase>(execute_data)->setIcon(sf::Vector2u(width, height), (uint8_t*)pixels->val);
    }
    ZEND_DLEXPORT void windowbase_getPosition(zend_execute_data *execute_data, zval *return_value) {
        auto position = storage_get<sf::WindowBase>(execute_data)->getPosition();
        array_init(return_value);
        add_next_index_long(return_value, position.x);
        add_next_index_long(return_value, position.y);
    }
    ZEND_DLEXPORT void windowbase_setPosition(zend_execute_data *execute_data, zval *return_value) {
        zval* position;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "a", &position) != SUCCESS) return;
        zend_long x = Z_LVAL_P(zend_hash_index_find(Z_ARRVAL_P(position), 0));
        zend_long y = Z_LVAL_P(zend_hash_index_find(Z_ARRVAL_P(position), 1));
        storage_get<sf::WindowBase>(execute_data)->setPosition(sf::Vector2i((int)x, (int)y));
    }
    ZEND_DLEXPORT void windowbase_setMinimumSize(zend_execute_data *execute_data, zval *return_value) {
        zval* minimumSize;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "a", &minimumSize) != SUCCESS) return;
        zend_long x = Z_LVAL_P(zend_hash_index_find(Z_ARRVAL_P(minimumSize), 0));
        zend_long y = Z_LVAL_P(zend_hash_index_find(Z_ARRVAL_P(minimumSize), 1));
        storage_get<sf::WindowBase>(execute_data)->setMinimumSize(sf::Vector2u(x, y));
    }
    ZEND_DLEXPORT void windowbase_setMaximumSize(zend_execute_data *execute_data, zval *return_value) {
        zval* maximumSize;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "a", &maximumSize) != SUCCESS) return;
        zend_long x = Z_LVAL_P(zend_hash_index_find(Z_ARRVAL_P(maximumSize), 0));
        zend_long y = Z_LVAL_P(zend_hash_index_find(Z_ARRVAL_P(maximumSize), 1));
        storage_get<sf::WindowBase>(execute_data)->setMaximumSize(sf::Vector2u(x, y));
    }
    ZEND_DLEXPORT void windowbase_setTitle(zend_execute_data *execute_data, zval *return_value) {
        zend_string* title_php;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "S", &title_php) != SUCCESS) return;
        storage_get<sf::WindowBase>(execute_data)->setTitle(sf::String::fromUtf8(title_php->val, title_php->val + title_php->len));
    }
    ZEND_DLEXPORT void windowbase_requestFocus(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        storage_get<sf::WindowBase>(execute_data)->requestFocus();
    }
    ZEND_DLEXPORT void windowbase_setVisible(zend_execute_data *execute_data, zval *return_value) {
        bool visible;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "b", &visible) != SUCCESS) return;
        storage_get<sf::WindowBase>(execute_data)->setVisible(visible);
    }
    ZEND_DLEXPORT void windowbase_setMouseCursorVisible(zend_execute_data *execute_data, zval *return_value) {
        bool mouseCursorVisible;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "b", &mouseCursorVisible) != SUCCESS) return;
        storage_get<sf::WindowBase>(execute_data)->setMouseCursorVisible(mouseCursorVisible);
    }
    ZEND_DLEXPORT void windowbase_setMouseCursorGrabbed(zend_execute_data *execute_data, zval *return_value) {
        bool mouseCursorGrabbed;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "b", &mouseCursorGrabbed) != SUCCESS) return;
        storage_get<sf::WindowBase>(execute_data)->setMouseCursorGrabbed(mouseCursorGrabbed);
    }
    ZEND_DLEXPORT void windowbase_setKeyRepeatEnabled(zend_execute_data *execute_data, zval *return_value) {
        bool keyRepeatEnabled;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "b", &keyRepeatEnabled) != SUCCESS) return;
        storage_get<sf::WindowBase>(execute_data)->setKeyRepeatEnabled(keyRepeatEnabled);
    }
    ZEND_DLEXPORT void windowbase_hasFocus(zend_execute_data *execute_data, zval *return_value) {
        bool hasFocus = storage_get<sf::WindowBase>(execute_data)->hasFocus();
        RETURN_BOOL(hasFocus);
    }
    ZEND_DLEXPORT void windowbase_setJoystickThreshold(zend_execute_data *execute_data, zval *return_value) {
        double joystickThreshold;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &joystickThreshold) != SUCCESS) return;
        storage_get<sf::WindowBase>(execute_data)->setJoystickThreshold((float)joystickThreshold);
    }
    ZEND_DLEXPORT void windowbase_setMouseCursor(zend_execute_data *execute_data, zval *return_value) {
        zval* mouseCursor_php;
        zend_class_entry* mouseCursor_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\Cursor"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "O", &mouseCursor_php, mouseCursor_ce) != SUCCESS) return;
        storage_get<sf::WindowBase>(execute_data)->setMouseCursor(*storage_get_const<sf::Cursor>(mouseCursor_php));
    }
    ZEND_DLEXPORT void windowbase_createVulkanSurface(zend_execute_data *execute_data, zval *return_value) {
        zval* instance_php;
        zend_string* surfaceClass;
        zval* allocator_php = nullptr;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "oS|!o", &instance_php, &surfaceClass, &allocator_php) != SUCCESS) return;
        auto* instance = *storage_get_const<VkInstance>(instance_php);
        auto* allocator = allocator_php != nullptr ? *storage_get_const<VkAllocationCallbacks*>(allocator_php) : nullptr;
        VkSurfaceKHR_T* surface;
        bool ok = storage_get<sf::WindowBase>(execute_data)->createVulkanSurface(instance, surface, allocator);
        if(!ok) RETURN_NULL();
        storage_new(return_value, surfaceClass, &surface);
    }
    ZEND_DLEXPORT void windowbase_getNativeHandle(zend_execute_data *execute_data, zval *return_value) {
        zend_string* handleClass;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "S", &handleClass) != SUCCESS) return;
        auto* handle = (sf::WindowHandle*)malloc(sizeof(sf::WindowHandle));
        *handle=storage_get<sf::WindowBase>(execute_data)->getNativeHandle();
        storage_new(return_value, handleClass, handle);
    }
}