#include <complex>
#include <iostream>
#include <map>

#include "php.h"
#include "zend_exceptions.h"
#include <SFML/Window.hpp>

#include "../main.hpp"
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
        // TODO overwrite if set in PHP
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
}