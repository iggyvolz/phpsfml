#include <complex>
#include <iostream>

#include "php.h"
#include "zend_exceptions.h"
#include <SFML/Window.hpp>

#include "../util.hpp"


extern "C" {
    ZEND_DLEXPORT void mouse_isButtonPressed(zend_execute_data *execute_data, zval *return_value) {
        zval *button_obj_php;
        zend_class_entry* type_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\MouseButton"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "O", &button_obj_php, type_ce) != SUCCESS) return;
        zval _;
        zval* button_php = zend_read_property(nullptr, Z_OBJ_P(button_obj_php), ZEND_STRL("value"), false, &_);
        auto button = static_cast<sf::Mouse::Button>(Z_LVAL_P(button_php));
        RETURN_BOOL(sf::Mouse::isButtonPressed(button));
    }
    ZEND_DLEXPORT void mouse_getPosition(zend_execute_data *execute_data, zval *return_value) {
        zval *relativeTo_php = nullptr;
        zend_class_entry* windowbase_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\WindowBase"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "|O", &relativeTo_php, windowbase_ce) != SUCCESS) return;
        int x, y;
        if (relativeTo_php == nullptr) {
            auto [_x, _y] = sf::Mouse::getPosition();
            x=_x; y=_y;
        } else {
            auto [_x, _y] = sf::Mouse::getPosition(*storage_get<sf::WindowBase>(relativeTo_php));
            x=_x; y=_y;
        }
        array_init(return_value);
        add_next_index_long(return_value, x);
        add_next_index_long(return_value, y);
    }
    ZEND_DLEXPORT void mouse_setPosition(zend_execute_data *execute_data, zval *return_value) {
        zend_long x, y;
        zval *relativeTo_php = nullptr;
        zend_class_entry* windowbase_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\WindowBase"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "ll|O", &x, &y, &relativeTo_php, windowbase_ce) != SUCCESS) return;
        if (relativeTo_php == nullptr) {
            sf::Mouse::setPosition(sf::Vector2i((int)x, (int)y));
        } else {
            sf::Mouse::setPosition(sf::Vector2i((int)x, (int)y), *storage_get<sf::WindowBase>(relativeTo_php));
        }
    }
}