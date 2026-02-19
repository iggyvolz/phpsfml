#include "php.h"
#include "../util.hpp"
#include "SFML/Window/Clipboard.hpp"
#include <SFML/System/String.hpp>

#include "SFML/Window/Joystick.hpp"

extern "C" {
    ZEND_DLEXPORT void joystick_isConnected(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        zval _;
        zval* id_php = zend_read_property(nullptr, Z_OBJ(execute_data->This), ZEND_STRL("index"), false, &_);
        zend_long id = Z_LVAL_P(id_php);
        RETURN_BOOL(sf::Joystick::isConnected(id));
    }
    ZEND_DLEXPORT void joystick_getButtonCount(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        zval _;
        zval* id_php = zend_read_property(nullptr, Z_OBJ(execute_data->This), ZEND_STRL("index"), false, &_);
        zend_long id = Z_LVAL_P(id_php);
        RETURN_LONG(sf::Joystick::getButtonCount(id));
    }
    ZEND_DLEXPORT void joystick_hasAxis(zend_execute_data *execute_data, zval *return_value) {
        zval *axis_obj_php;
        zend_class_entry* type_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\Joystick\\Axis"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "O", &axis_obj_php, type_ce) != SUCCESS) return;
        zval _;
        zval* axis_php = zend_read_property(nullptr, Z_OBJ_P(axis_obj_php), ZEND_STRL("value"), false, &_);
        auto axis = static_cast<sf::Joystick::Axis>(Z_LVAL_P(axis_php));
        zval value;
        zval* x = zend_read_property(nullptr, Z_OBJ(execute_data->This), ZEND_STRL("index"), false, &value);
        zend_long id = Z_LVAL_P(x);
        RETURN_BOOL(sf::Joystick::hasAxis(id, axis));
    }
    ZEND_DLEXPORT void joystick_isButtonPressed(zend_execute_data *execute_data, zval *return_value) {
        zend_long button;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "l", &button) != SUCCESS) return;
        zval _;
        zval* id_php = zend_read_property(nullptr, Z_OBJ(execute_data->This), ZEND_STRL("index"), false, &_);
        zend_long id = Z_LVAL_P(id_php);
        RETURN_BOOL(sf::Joystick::isButtonPressed(id, button));
    }
    ZEND_DLEXPORT void joystick_getAxisPosition(zend_execute_data *execute_data, zval *return_value) {
        zval *axis_obj_php;
        zend_class_entry* type_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\Joystick\\Axis"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "O", &axis_obj_php, type_ce) != SUCCESS) return;
        zval _;
        zval* axis_php = zend_read_property(nullptr, Z_OBJ_P(axis_obj_php), ZEND_STRL("value"), false, &_);
        auto axis = static_cast<sf::Joystick::Axis>(Z_LVAL_P(axis_php));
        zval value;
        zval* x = zend_read_property(nullptr, Z_OBJ(execute_data->This), ZEND_STRL("index"), false, &value);
        zend_long id = Z_LVAL_P(x);
        RETURN_DOUBLE(sf::Joystick::getAxisPosition(id, axis));
    }
    ZEND_DLEXPORT void joystick_getName(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        zval _;
        zval* id_php = zend_read_property(nullptr, Z_OBJ(execute_data->This), ZEND_STRL("index"), false, &_);
        zend_long id = Z_LVAL_P(id_php);
        auto* name = new sf::String(sf::Joystick::getIdentification(id).name);
        RETURN_STRINGL(reinterpret_cast<const char *>(name->toUtf8().c_str()), name->toUtf8().size());
    }
    ZEND_DLEXPORT void joystick_getVendorId(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        zval _;
        zval* id_php = zend_read_property(nullptr, Z_OBJ(execute_data->This), ZEND_STRL("index"), false, &_);
        zend_long id = Z_LVAL_P(id_php);
        RETURN_LONG(sf::Joystick::getIdentification(id).vendorId);
    }
    ZEND_DLEXPORT void joystick_getProductId(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        zval _;
        zval* id_php = zend_read_property(nullptr, Z_OBJ(execute_data->This), ZEND_STRL("index"), false, &_);
        zend_long id = Z_LVAL_P(id_php);
        RETURN_LONG(sf::Joystick::getIdentification(id).productId);
    }
    ZEND_DLEXPORT void joystick_update(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        sf::Joystick::update();
    }
}
