#include "php.h"
#include "../util.hpp"
#include "SFML/Window/Clipboard.hpp"
#include <SFML/System/String.hpp>

extern "C" {
    ZEND_DLEXPORT void getClipboard(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        auto* str = new sf::String(sf::Clipboard::getString());
        storage_new(return_value, R"(iggyvolz\SFML\Utils\SfString)", str);
    }
    ZEND_DLEXPORT void setClipboard(zend_execute_data *execute_data, zval *return_value) {
        zval* clipboard;
        zend_class_entry* string_ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Utils\\SfString"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "O", &clipboard, string_ce) != SUCCESS) return;
        sf::Clipboard::setString(*storage_get_const<sf::String>(clipboard));
    }
}