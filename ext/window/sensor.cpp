#include <complex>
#include <iostream>

#include "php.h"
#include "zend_exceptions.h"
#include <SFML/Window.hpp>

#include "../util.hpp"


extern "C" {
    ZEND_DLEXPORT void sensor_isAvailable(zend_execute_data *execute_data, zval *return_value) {
        zval *type_obj_php;
        zend_class_entry* type_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\SensorType"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "O", &type_obj_php, type_ce) != SUCCESS) return;
        zval _;
        zval* type_php = zend_read_property(nullptr, Z_OBJ_P(type_obj_php), ZEND_STRL("value"), false, &_);
        auto type = static_cast<sf::Sensor::Type>(Z_LVAL_P(type_php));
        RETURN_BOOL(sf::Sensor::isAvailable(type));
    }
    ZEND_DLEXPORT void sensor_setEnabled(zend_execute_data *execute_data, zval *return_value) {
        zval *type_obj_php;
        bool available;
        zend_class_entry* type_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\SensorType"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "Ob", &type_obj_php, type_ce, &available) != SUCCESS) return;
        zval _;
        zval* type_php = zend_read_property(nullptr, Z_OBJ_P(type_obj_php), ZEND_STRL("value"), false, &_);
        auto type = static_cast<sf::Sensor::Type>(Z_LVAL_P(type_php));
        sf::Sensor::setEnabled(type, available);
    }
    ZEND_DLEXPORT void sensor_getValue(zend_execute_data *execute_data, zval *return_value) {
        zval *type_obj_php;
        zend_class_entry* type_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\SensorType"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "O", &type_obj_php, type_ce) != SUCCESS) return;
        zval _;
        zval* type_php = zend_read_property(nullptr, Z_OBJ_P(type_obj_php), ZEND_STRL("value"), false, &_);
        auto type = static_cast<sf::Sensor::Type>(Z_LVAL_P(type_php));
        auto [x, y, z] = sf::Sensor::getValue(type);
        array_init(return_value);
        add_next_index_double(return_value, x);
        add_next_index_double(return_value, y);
        add_next_index_double(return_value, z);
    }
}