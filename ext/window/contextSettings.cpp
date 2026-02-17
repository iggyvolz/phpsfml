#include "php.h"
#include "../util.hpp"
#include "SFML/Window/ContextSettings.hpp"

extern "C" {
    ZEND_DLEXPORT void contextSettings_construct(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        storage_put(execute_data, new sf::ContextSettings());
    }
    ZEND_DLEXPORT void contextSettings_destruct(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        storage_remove<sf::ContextSettings>(execute_data);
    }
    ZEND_DLEXPORT void contextSettings_getDepthBits(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        auto context = storage_get_const<sf::ContextSettings>(execute_data);
        RETURN_LONG(context->depthBits);
    }
    ZEND_DLEXPORT void contextSettings_setDepthBits(zend_execute_data *execute_data, zval *return_value) {
        zend_long value;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &value) != SUCCESS) return;
        auto context = storage_get<sf::ContextSettings>(execute_data);
        context->depthBits = value;
    }
    ZEND_DLEXPORT void contextSettings_getStencilBits(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        auto context = storage_get_const<sf::ContextSettings>(execute_data);
        RETURN_LONG(context->stencilBits);
    }
    ZEND_DLEXPORT void contextSettings_setStencilBits(zend_execute_data *execute_data, zval *return_value) {
        zend_long value;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &value) != SUCCESS) return;
        auto context = storage_get<sf::ContextSettings>(execute_data);
        context->stencilBits = value;
    }
    ZEND_DLEXPORT void contextSettings_getAntialiasingLevel(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        auto context = storage_get_const<sf::ContextSettings>(execute_data);
        RETURN_LONG(context->antiAliasingLevel);
    }
    ZEND_DLEXPORT void contextSettings_setAntialiasingLevel(zend_execute_data *execute_data, zval *return_value) {
        zend_long value;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &value) != SUCCESS) return;
        auto context = storage_get<sf::ContextSettings>(execute_data);
        context->antiAliasingLevel = value;
    }
    ZEND_DLEXPORT void contextSettings_getMajorVersion(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        auto context = storage_get_const<sf::ContextSettings>(execute_data);
        RETURN_LONG(context->majorVersion);
    }
    ZEND_DLEXPORT void contextSettings_setMajorVersion(zend_execute_data *execute_data, zval *return_value) {
        zend_long value;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &value) != SUCCESS) return;
        auto context = storage_get<sf::ContextSettings>(execute_data);
        context->majorVersion = value;
    }
    ZEND_DLEXPORT void contextSettings_getMinorVersion(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        auto context = storage_get_const<sf::ContextSettings>(execute_data);
        RETURN_LONG(context->minorVersion);
    }
    ZEND_DLEXPORT void contextSettings_setMinorVersion(zend_execute_data *execute_data, zval *return_value) {
        zend_long value;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &value) != SUCCESS) return;
        auto context = storage_get<sf::ContextSettings>(execute_data);
        context->minorVersion = value;
    }
    ZEND_DLEXPORT void contextSettings_getAttributeFlags(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        auto context = storage_get_const<sf::ContextSettings>(execute_data);
        array_init(return_value);
        uint32_t flags = context->attributeFlags;
        zval obj;
        for (zend_long i = 0; flags != 0; i++) {
            if (flags & 1) {
                enum_get(&obj, R"(iggyvolz\SFML\Window\ContextAttribute)", i);
                ZEND_ASSERT(add_next_index_zval(return_value, &obj) == SUCCESS);
            }
            flags >>= 1;
        }
    }
    ZEND_DLEXPORT void contextSettings_setAttributeFlags(zend_execute_data *execute_data, zval *return_value) {
        zval* value;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "a", &value) != SUCCESS) return;
        auto context = storage_get<sf::ContextSettings>(execute_data);
        context->attributeFlags = 0;
        zval *val;
        ZEND_HASH_FOREACH_VAL(value->value.arr, val) {
            zval y;
            zval* x = zend_read_property(nullptr, Z_OBJ_P(val), ZEND_STRL("value"), false, &y);
            context->attributeFlags |= 1 << Z_LVAL_P(x);
        } ZEND_HASH_FOREACH_END();
    }
    ZEND_DLEXPORT void contextSettings_getSRgbCapable(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        auto context = storage_get_const<sf::ContextSettings>(execute_data);
        RETURN_BOOL(context->sRgbCapable);
    }
    ZEND_DLEXPORT void contextSettings_setSRgbCapable(zend_execute_data *execute_data, zval *return_value) {
        bool value;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "b", &value) != SUCCESS) return;
        auto context = storage_get<sf::ContextSettings>(execute_data);
        context->sRgbCapable = value;
    }
}
