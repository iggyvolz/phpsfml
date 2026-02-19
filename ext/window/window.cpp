#include <complex>
#include <iostream>
#include <map>

#include "php.h"
#include "zend_exceptions.h"
#include <SFML/Window.hpp>

#include "../util.hpp"
#include "event.hpp"

#define SPEM_DEBUG 0


extern "C" {
    ZEND_DLEXPORT void window_construct(zend_execute_data *execute_data, zval *return_value) {
        zval* mode_php;
        zend_class_entry* videomode_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\VideoMode"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        zend_string* title_php;
        zval* window_style_arr = nullptr;
        zval* state_php = nullptr;
        zend_class_entry* state_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\State"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);

        zval* contextsettings_php = nullptr;
        zend_class_entry* contextsettings_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\ContextSettings"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);



        if(zend_parse_parameters(ZEND_NUM_ARGS(), "OS|aOO", &mode_php, videomode_ce, &title_php, &window_style_arr, &state_php, state_ce, &contextsettings_php, contextsettings_ce) != SUCCESS) return;
        auto mode = *storage_get<sf::VideoMode>(mode_php);
        auto title = sf::String::fromUtf8(title_php->val, title_php->val + title_php->len);
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
        auto contextSettings = (contextsettings_php == nullptr) ? sf::ContextSettings() : *storage_get_const<sf::ContextSettings>(contextsettings_php);
        storage_put(execute_data, new sf::Window(mode, title, window_style, state, contextSettings));
    }
    ZEND_DLEXPORT void window_getSettings(zend_execute_data *execute_data, zval *return_value) {
        if (zend_parse_parameters_none() != SUCCESS) return;
        auto* window = storage_get<sf::Window>(execute_data);
        storage_put(return_value, new sf::ContextSettings(window->getSettings()));
    }
    ZEND_DLEXPORT void window_setVerticalSyncEnabled(zend_execute_data *execute_data, zval *return_value) {
        bool verticalSyncEnabled;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "b", &verticalSyncEnabled) != SUCCESS) return;
        storage_get<sf::Window>(execute_data)->setVerticalSyncEnabled(verticalSyncEnabled);
    }
    ZEND_DLEXPORT void window_setFramerateLimit(zend_execute_data *execute_data, zval *return_value) {
        zend_long framerateLimit;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "l", &framerateLimit) != SUCCESS) return;
        storage_get<sf::Window>(execute_data)->setFramerateLimit(framerateLimit);
    }
    ZEND_DLEXPORT void window_display(zend_execute_data *execute_data, zval *return_value) {
        if (zend_parse_parameters_none() != SUCCESS) return;
        auto* window = storage_get<sf::Window>(execute_data);
        window->display();
    }

}