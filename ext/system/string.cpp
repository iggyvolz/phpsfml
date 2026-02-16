#include <iostream>
#include "php.h"
#include "zend_exceptions.h"
#include <SFML/System.hpp>
#include "../util.hpp"

extern "C" {
    ZEND_DLEXPORT void sfstring_construct(zend_execute_data *execute_data, zval *return_value) {
        zend_string* utf8;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "S", &utf8) != SUCCESS) return;
        auto string = new sf::String();
        string->insert(0, sf::String::fromUtf8(utf8->val, utf8->val + utf8->len));
        storage_put(execute_data, string);
    }
    ZEND_DLEXPORT void sfstring_tostring(zend_execute_data *execute_data, zval *return_value) {
        auto string = storage_get_const<sf::String>(execute_data);
        const sf::U8String utf8 = string->toUtf8();
        RETURN_STRINGL(reinterpret_cast<const char *>(utf8.data()), utf8.size());
    }
    ZEND_DLEXPORT void sfstring_append(zend_execute_data *execute_data, zval *return_value) {
        zend_string* arg;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "S", &arg) != SUCCESS) return;
        auto string = storage_get<sf::String>(execute_data);
        *string += sf::String::fromUtf8(arg->val, arg->val + arg->len);
    }
    ZEND_DLEXPORT void sfstring_clear(zend_execute_data *execute_data, zval *return_value) {
        auto string = storage_get<sf::String>(execute_data);
        string->clear();
    }
    ZEND_DLEXPORT void sfstring_size(zend_execute_data *execute_data, zval *return_value) {
        auto string = storage_get_const<sf::String>(execute_data);
        RETURN_LONG(string->getSize());
    }
    ZEND_DLEXPORT void sfstring_isEmpty(zend_execute_data *execute_data, zval *return_value) {
        auto string = storage_get_const<sf::String>(execute_data);
        RETURN_BOOL(string->isEmpty());
    }
    ZEND_DLEXPORT void sfstring_erase(zend_execute_data *execute_data, zval *return_value) {
        long position;
        long count = 1;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "l|l", &position, &count) != SUCCESS) return;
        auto string = storage_get<sf::String>(execute_data);
        string->erase(position, count);
    }
    ZEND_DLEXPORT void sfstring_insert(zend_execute_data *execute_data, zval *return_value) {
        long position;
        zval* str;
        zend_class_entry* ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Utils\\SfString"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "lO", &position, &str, ce) != SUCCESS) return;
        auto string = storage_get<sf::String>(execute_data);
        string->insert(position, *storage_get_const<sf::String>(str));
    }
    ZEND_DLEXPORT void sfstring_find(zend_execute_data *execute_data, zval *return_value) {
        zval* str;
        zend_class_entry* ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Utils\\SfString"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        long start = 0;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "O|l", &str, ce, &start) != SUCCESS) return;
        auto string = storage_get_const<sf::String>(execute_data);
        std::size_t result = string->find(*storage_get_const<sf::String>(str), start);
        if (result == std::u32string::npos) {
            RETURN_NULL();
        } else {
            RETURN_LONG(result);
        }
    }
    ZEND_DLEXPORT void sfstring_replaceLength(zend_execute_data *execute_data, zval *return_value) {
        int position, length;
        zval* replaceWith;
        zend_class_entry* ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Utils\\SfString"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "llO", &position, &length, &replaceWith, ce) != SUCCESS) return;
        auto string = storage_get<sf::String>(execute_data);
        string->replace(position, length, *storage_get_const<sf::String>(replaceWith));
    }
    ZEND_DLEXPORT void sfstring_replaceString(zend_execute_data *execute_data, zval *return_value) {
        zval *searchFor, *replaceWith;
        zend_class_entry* ce = zend_lookup_class_ex(zend_string_init(ZEND_STRL("iggyvolz\\SFML\\Utils\\SfString"), false), nullptr, ZEND_FETCH_CLASS_EXCEPTION);
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "OO", &searchFor, ce, &replaceWith, ce) != SUCCESS) return;
        auto string = storage_get<sf::String>(execute_data);
        string->replace(*storage_get_const<sf::String>(searchFor), *storage_get_const<sf::String>(replaceWith));
    }
    ZEND_DLEXPORT void sfstring_substring(zend_execute_data *execute_data, zval *return_value) {
        zend_long position;
        zend_long _length = 0;
        bool length_null = true;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "l!l", &position, &_length, &length_null) != SUCCESS) return;
        std::size_t length = length_null ? std::u32string::npos : _length;
        auto string = storage_get_const<sf::String>(execute_data);
        auto processed = new sf::String();
        *processed = string->substring(position, length);
        storage_new(return_value, R"(iggyvolz\SFML\Utils\SfString)", processed);
    }
    ZEND_DLEXPORT void sfstring_destruct(zend_execute_data *execute_data, zval *return_value) {
        storage_remove<sf::String>(execute_data);
    }
}
