#include "php.h"
#include "../util.hpp"
#include "SFML/Window/Clipboard.hpp"
#include <SFML/System/String.hpp>

#include "SFML/Window/Joystick.hpp"
#include "SFML/Window/Keyboard.hpp"

extern "C" {
    ZEND_DLEXPORT void keyboard_isKeyPressed(zend_execute_data *execute_data, zval *return_value) {
        zval *key_obj_php;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "o", &key_obj_php) != SUCCESS) return;
        zend_class_entry* key_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\Keyboard"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        zend_class_entry* scancode_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\Scancode"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);

        if (instanceof_function(Z_OBJCE_P(key_obj_php), key_ce)) {
            zval _;
            zval* key_php = zend_read_property(nullptr, Z_OBJ_P(key_obj_php), ZEND_STRL("value"), false, &_);
            auto key = static_cast<sf::Keyboard::Key>(Z_LVAL_P(key_php));
            RETURN_BOOL(sf::Keyboard::isKeyPressed(key));
        }
        if (instanceof_function(Z_OBJCE_P(key_obj_php), scancode_ce)) {
            zval _;
            zval* key_php = zend_read_property(nullptr, Z_OBJ_P(key_obj_php), ZEND_STRL("value"), false, &_);
            auto key = static_cast<sf::Keyboard::Scancode>(Z_LVAL_P(key_php));
            RETURN_BOOL(sf::Keyboard::isKeyPressed(key));
        }
        RETURN_THROWS();
    }
    ZEND_DLEXPORT void keyboard_setVirtualKeyboardVisible(zend_execute_data *execute_data, zval *return_value) {
        bool visible;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "b", &visible) != SUCCESS) return;
        sf::Keyboard::setVirtualKeyboardVisible(visible);
    }
    ZEND_DLEXPORT void key_delocalize(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        zval _;
        zval* key_php = zend_read_property(nullptr, Z_OBJ(execute_data->This), ZEND_STRL("value"), false, &_);
        auto key = static_cast<sf::Keyboard::Key>(Z_LVAL_P(key_php));
        enum_get(return_value, R"(iggyvolz\SFML\Window\Scancode)", (zend_long)sf::Keyboard::delocalize(key));
    }
    ZEND_DLEXPORT void spem_iggyvolz_SFML_Window_Scancode_localize(zend_execute_data *execute_data, zval *return_value) {
        std::cout << "localize" << std::endl;
        if(zend_parse_parameters_none() != SUCCESS) return;
        zval _;
        zval* key_php = zend_read_property(nullptr, Z_OBJ(execute_data->This), ZEND_STRL("value"), false, &_);
        auto code = static_cast<sf::Keyboard::Scancode>(Z_LVAL_P(key_php));
        enum_get(return_value, R"(iggyvolz\SFML\Window\Scancode)", (zend_long)sf::Keyboard::localize(code));
    }
    ZEND_DLEXPORT void scancode_getDescription(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        zval _;
        zval* key_php = zend_read_property(nullptr, Z_OBJ(execute_data->This), ZEND_STRL("value"), false, &_);
        auto code = static_cast<sf::Keyboard::Scancode>(Z_LVAL_P(key_php));
        auto* name = new sf::String(sf::Keyboard::getDescription(code));
        RETURN_STRINGL(reinterpret_cast<const char *>(name->toUtf8().c_str()), name->toUtf8().size());
    }
}
