#include <complex>
#include <iostream>
#include <map>

#include "php.h"
#include "zend_exceptions.h"
#include <SFML/Window.hpp>

#include "../util.hpp"

extern "C" {
    ZEND_DLEXPORT void videomode_construct(zend_execute_data *execute_data, zval *return_value) {
        zend_long width, height;
        zend_long bitsPerPixel = 32;
        zend_parse_parameters(ZEND_NUM_ARGS(), "ll|l", &width, &height, &bitsPerPixel);
        storage_put(execute_data, new sf::VideoMode(sf::Vector2u(width, height), bitsPerPixel));
    }
    ZEND_DLEXPORT void videomode_getwidth(zend_execute_data *execute_data, zval *return_value) {
        RETURN_LONG(storage_get<sf::VideoMode>(execute_data)->size.x);
    }
    ZEND_DLEXPORT void videomode_setwidth(zend_execute_data *execute_data, zval *return_value) {
        long value;
        zend_parse_parameters(ZEND_NUM_ARGS(), "l", &value);
        storage_get<sf::VideoMode>(execute_data)->size.x = value;
    }
    ZEND_DLEXPORT void videomode_getheight(zend_execute_data *execute_data, zval *return_value) {
        RETURN_LONG(storage_get<sf::VideoMode>(execute_data)->size.y);
    }
    ZEND_DLEXPORT void videomode_setheight(zend_execute_data *execute_data, zval *return_value) {
        long value;
        zend_parse_parameters(ZEND_NUM_ARGS(), "l", &value);
        storage_get<sf::VideoMode>(execute_data)->size.y = value;
    }
    ZEND_DLEXPORT void videomode_getbitsperpixel(zend_execute_data *execute_data, zval *return_value) {
        RETURN_LONG(storage_get<sf::VideoMode>(execute_data)->bitsPerPixel);
    }
    ZEND_DLEXPORT void videomode_setbitsperpixel(zend_execute_data *execute_data, zval *return_value) {
        long value;
        zend_parse_parameters(ZEND_NUM_ARGS(), "l", &value);
        storage_get<sf::VideoMode>(execute_data)->bitsPerPixel = value;
    }
    ZEND_DLEXPORT void videomode_isvalid(zend_execute_data *execute_data, zval *return_value) {
        RETURN_BOOL(storage_get<sf::VideoMode>(execute_data)->isValid());
    }
    ZEND_DLEXPORT void videomode_destruct(zend_execute_data *execute_data, zval *return_value) {
        storage_remove<sf::VideoMode>(execute_data);
    }
}
