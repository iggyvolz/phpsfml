#include <complex>
#include <iostream>

#include "php.h"
#include "zend_exceptions.h"
#include <SFML/Window.hpp>

#include "../util.hpp"


extern "C" {
    ZEND_DLEXPORT void touch_isDown(zend_execute_data *execute_data, zval *return_value) {
        zend_long finger;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "l", &finger) != SUCCESS) return;
        RETURN_BOOL(sf::Touch::isDown(finger));
    }
    ZEND_DLEXPORT void touch_getPosition(zend_execute_data *execute_data, zval *return_value) {
        zend_long finger;
        zval *relativeTo_php = nullptr;
        zend_class_entry* windowbase_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\WindowBase"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "l|O", &finger, &relativeTo_php, windowbase_ce) != SUCCESS) return;
        int x, y;
        if (relativeTo_php == nullptr) {
            auto [_x, _y] = sf::Touch::getPosition(finger);
            x=_x; y=_y;
        } else {
            auto [_x, _y] = sf::Touch::getPosition(finger, *storage_get<sf::WindowBase>(relativeTo_php));
            x=_x; y=_y;
        }
        array_init(return_value);
        add_next_index_long(return_value, x);
        add_next_index_long(return_value, y);
    }
}