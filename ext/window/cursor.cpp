#include "php.h"
#include "../util.hpp"
#include "SFML/Window/Cursor.hpp"

extern "C" {
    ZEND_DLEXPORT void cursor_createFromPixels(zend_execute_data *execute_data, zval *return_value) {
        zend_long width, height, hotspotX, hotspotY;
        zend_string* pixels;

        if(zend_parse_parameters(ZEND_NUM_ARGS(), "Sllll", &pixels, &width, &height, &hotspotX, &hotspotY) != SUCCESS) return;
        storage_new(return_value, R"(iggyvolz\SFML\Window\Cursor)", new sf::Cursor((uint8_t*)pixels->val, sf::Vector2u(width, height), sf::Vector2u(width, height)));
    }
    ZEND_DLEXPORT void cursor_createFromSystem(zend_execute_data *execute_data, zval *return_value) {
        zval *type;
        zend_class_entry* type_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Window\\CursorType"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "O", &type, type_ce) != SUCCESS) return;
        zval _;
        zval* x = zend_read_property(nullptr, Z_OBJ_P(type), ZEND_STRL("value"), false, &_);
        auto cursorType = static_cast<sf::Cursor::Type>(Z_LVAL_P(x));
        storage_new(return_value, R"(iggyvolz\SFML\Window\Cursor)", new sf::Cursor(cursorType));
    }
    ZEND_DLEXPORT void cursor_destruct(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        storage_remove<sf::Cursor>(execute_data);
    }
}
