#include "php.h"
#include "../util.hpp"
#include "SFML/Window/Clipboard.hpp"
#include <SFML/System/String.hpp>

extern "C" {
    ZEND_DLEXPORT void getClipboard(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        auto* str = new sf::String(sf::Clipboard::getString());
        RETURN_STRINGL(reinterpret_cast<const char *>(str->toUtf8().c_str()), str->toUtf8().size());
    }
    ZEND_DLEXPORT void setClipboard(zend_execute_data *execute_data, zval *return_value) {
        zend_string* clipboard;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "O", &clipboard) != SUCCESS) return;
        sf::Clipboard::setString(sf::String::fromUtf8(ZSTR_VAL(clipboard), ZSTR_VAL(clipboard) + ZSTR_LEN(clipboard)));
    }
}