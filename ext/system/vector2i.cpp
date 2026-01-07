#include <complex>
#include <iostream>
#include <map>

#include "php.h"
#include "zend_exceptions.h"
#include <SFML/System.hpp>

#include "../main.hpp"

extern "C" {
    ZEND_DLEXPORT void vector2i_construct(zend_execute_data *execute_data, zval *return_value) {
        zend_long x, y;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "ll", &x, &y) == SUCCESS);
        storage_put(execute_data, new sf::Vector2i(static_cast<int>(x), static_cast<int>(y)));
    }
    ZEND_DLEXPORT void vector2i_getx(zend_execute_data *execute_data, zval *return_value) {
        RETURN_LONG(storage_get<sf::Vector2i>(execute_data)->x);
    }
    ZEND_DLEXPORT void vector2i_gety(zend_execute_data *execute_data, zval *return_value) {
        RETURN_LONG(storage_get<sf::Vector2i>(execute_data)->y);
    }
    ZEND_DLEXPORT void vector2i_setx(zend_execute_data *execute_data, zval *return_value) {
        zend_long x;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "l", &x) == SUCCESS);
        storage_get<sf::Vector2i>(execute_data)->x = static_cast<int>(x);
    }
    ZEND_DLEXPORT void vector2i_sety(zend_execute_data *execute_data, zval *return_value) {
        zend_long y;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "l", &y) == SUCCESS);
        storage_get<sf::Vector2i>(execute_data)->y = static_cast<int>(y);
    }

    ZEND_DLEXPORT void vector2i_destruct(zend_execute_data *execute_data, zval *return_value) {
        storage_remove<sf::Vector2i>(execute_data);
    }
}
