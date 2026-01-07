#include <iostream>
#include "php.h"
#include "zend_exceptions.h"
#include <SFML/System.hpp>

#include "../util.hpp"
extern "C" {
    ZEND_DLEXPORT void vector3f_construct(zend_execute_data *execute_data, zval *return_value) {
        double x, y, z;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "ddd", &x, &y, &z) == SUCCESS);
        storage_put(execute_data, new sf::Vector3f(static_cast<float>(x), static_cast<float>(y), static_cast<float>(z)));
    }
    ZEND_DLEXPORT void vector3f_getx(zend_execute_data *execute_data, zval *return_value) {
        RETURN_DOUBLE(storage_get<sf::Vector3f>(execute_data)->x);
    }
    ZEND_DLEXPORT void vector3f_gety(zend_execute_data *execute_data, zval *return_value) {
        RETURN_DOUBLE(storage_get<sf::Vector3f>(execute_data)->y);
    }
    ZEND_DLEXPORT void vector3f_getz(zend_execute_data *execute_data, zval *return_value) {
        RETURN_DOUBLE(storage_get<sf::Vector3f>(execute_data)->z);
    }
    ZEND_DLEXPORT void vector3f_setx(zend_execute_data *execute_data, zval *return_value) {
        double x;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &x) == SUCCESS);
        storage_get<sf::Vector3f>(execute_data)->x = static_cast<float>(x);
    }
    ZEND_DLEXPORT void vector3f_sety(zend_execute_data *execute_data, zval *return_value) {
        double y;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &y) == SUCCESS);
        storage_get<sf::Vector3f>(execute_data)->y = static_cast<float>(y);
    }
    ZEND_DLEXPORT void vector3f_setz(zend_execute_data *execute_data, zval *return_value) {
        double z;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &z) == SUCCESS);
        storage_get<sf::Vector3f>(execute_data)->z = static_cast<float>(z);
    }


    ZEND_DLEXPORT void vector3f_destruct(zend_execute_data *execute_data, zval *return_value) {
        storage_remove<sf::Vector3f>(execute_data);
    }
}