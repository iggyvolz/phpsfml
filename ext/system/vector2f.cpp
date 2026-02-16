#include <complex>
#include <iostream>
#include <map>

#include "php.h"
#include "zend_exceptions.h"
#include <SFML/System.hpp>

#include "../util.hpp"

extern "C" {
    ZEND_DLEXPORT void vector2f_construct(zend_execute_data *execute_data, zval *return_value) {
        double x, y;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "dd", &x, &y) == SUCCESS);
        storage_put(execute_data, new sf::Vector2f(static_cast<float>(x), static_cast<float>(y)));
    }
    ZEND_DLEXPORT void vector2f_getx(zend_execute_data *execute_data, zval *return_value) {
        RETURN_DOUBLE(storage_get_const<sf::Vector2f>(execute_data)->x);
    }
    ZEND_DLEXPORT void vector2f_gety(zend_execute_data *execute_data, zval *return_value) {
        RETURN_DOUBLE(storage_get_const<sf::Vector2f>(execute_data)->y);
    }
    ZEND_DLEXPORT void vector2f_setx(zend_execute_data *execute_data, zval *return_value) {
        double x;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &x) == SUCCESS);
        storage_get<sf::Vector2f>(execute_data)->x = static_cast<float>(x);
    }
    ZEND_DLEXPORT void vector2f_sety(zend_execute_data *execute_data, zval *return_value) {
        double y;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &y) == SUCCESS);
        storage_get<sf::Vector2f>(execute_data)->y = static_cast<float>(y);
    }

    ZEND_DLEXPORT void vector2f_destruct(zend_execute_data *execute_data, zval *return_value) {
        storage_remove<sf::Vector2f>(execute_data);
    }
}
