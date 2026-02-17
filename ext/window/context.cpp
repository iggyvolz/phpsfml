#include "php.h"
#include "../util.hpp"
#include "SFML/Window/Context.hpp"
#include "SFML/Window/ContextSettings.hpp"

extern "C" {
    ZEND_DLEXPORT void context_construct(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        storage_put(execute_data, new sf::Context());
    }
    ZEND_DLEXPORT void context_destruct(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        storage_remove<sf::Context>(execute_data);
    }
    ZEND_DLEXPORT void context_getSettings(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        auto context = storage_get_const<sf::Context>(execute_data);
        auto* settings = (sf::ContextSettings*) emalloc(sizeof(sf::ContextSettings));
        *settings = context->getSettings();
        storage_new(return_value, R"(iggyvolz\SFML\Window\ContextSettings)", settings);
    }
    ZEND_DLEXPORT void context_setActive(zend_execute_data *execute_data, zval *return_value) {
        zend_long value;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "b", &value) != SUCCESS) return;
        auto context = storage_get<sf::Context>(execute_data);
        RETURN_BOOL(context->setActive(value));
    }
    ZEND_DLEXPORT void context_isExtensionAvailable(zend_execute_data *execute_data, zval *return_value) {
        zend_string *value;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "S", &value) != SUCCESS) return;
        RETURN_BOOL(sf::Context::isExtensionAvailable(std::string_view(ZSTR_VAL(value), ZSTR_LEN(value))));
    }
    ZEND_DLEXPORT void context_getActiveContext(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        storage_new(return_value, R"(iggyvolz\SFML\Window\Context)", sf::Context::getActiveContext());
    }
    ZEND_DLEXPORT void context_getActiveContextId(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        RETURN_LONG(sf::Context::getActiveContextId());
    }
}
