#include <iostream>
#include <map>

#include "php.h"
#include <SFML/System.hpp>

#include "../main.hpp"

class PhpInputStream : public sf::InputStream
{
    zval object;
public:
    explicit PhpInputStream(zval object) {
        this->object = object;
        Z_ADDREF_P(&object);
    }
    ~PhpInputStream() override {
        Z_DELREF_P(&object);
    }

    [[nodiscard]] std::optional<std::size_t> read(void* data, std::size_t size) override {
        zval params[1];
        ZVAL_LONG(&params[0], size);
        zval method_name;
        ZVAL_STRING(&method_name, "read");
        zval retval;
        // function_table, object, function_name, retval_ptr, param_count, params
        ZEND_ASSERT(call_user_function(nullptr, &object, &method_name, &retval, 1, params) == SUCCESS);
        ZEND_ASSERT(Z_TYPE(retval) == IS_STRING);
        size_t len = Z_STRLEN(retval);
        if (len > size) len = size; // Buffer safety
        memcpy(data, Z_STRVAL(retval), len);
        zval_ptr_dtor(&retval);
        zval_ptr_dtor(&method_name);
        return len;
    }

    [[nodiscard]] std::optional<std::size_t> seek(std::size_t position) override {
        zval params[1];
        ZVAL_LONG(&params[0], position);
        zval method_name;
        ZVAL_STRING(&method_name, "seek");
        zval retval;
        ZEND_ASSERT(call_user_function(nullptr, &object, &method_name, &retval, 1, params) == SUCCESS);
        ZEND_ASSERT(Z_TYPE(retval) == IS_LONG || Z_TYPE(retval) == IS_NULL);
        const std::optional<std::size_t> ret = Z_TYPE(retval) == IS_NULL ? std::nullopt : std::optional(Z_LVAL(retval));
        zval_ptr_dtor(&retval);
        zval_ptr_dtor(&method_name);
        return ret;
    }

    [[nodiscard]] std::optional<std::size_t> tell() override {
        zval method_name, retval;
        ZVAL_STRING(&method_name, "tell");
        ZEND_ASSERT(call_user_function(nullptr, &object, &method_name, &retval, 0, nullptr) == SUCCESS);
        ZEND_ASSERT(Z_TYPE(retval) == IS_LONG || Z_TYPE(retval) == IS_NULL);
        const std::optional<std::size_t> ret = Z_TYPE(retval) == IS_NULL ? std::nullopt : std::optional(Z_LVAL(retval));
        zval_ptr_dtor(&retval);
        zval_ptr_dtor(&method_name);
        return ret;

    }

    std::optional<std::size_t> getSize() override {
        zval _retval;
        zval *retval = zend_read_property(Z_OBJCE(object), Z_OBJ(object), ZEND_STRL("size"), false, &_retval);
        ZEND_ASSERT(Z_TYPE_P(retval) == IS_LONG || Z_TYPE_P(retval) == IS_NULL);
        const std::optional<std::size_t> ret = Z_TYPE_P(retval) == IS_NULL ? std::nullopt : std::optional(Z_LVAL_P(retval));
        zval_ptr_dtor(retval);
        return ret;
    }
};

extern "C" {
    ZEND_DLEXPORT void inputstream_construct(zend_execute_data *execute_data, zval *return_value) {
        zval* obj;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "o", &obj) == SUCCESS);
        storage_put(execute_data, new PhpInputStream(*obj));
    }
    ZEND_DLEXPORT void inputstream_read(zend_execute_data *execute_data, zval *return_value) {
        auto stream = storage_get<sf::InputStream>(execute_data);
        long size = Z_LVAL_P(ZEND_CALL_ARG(execute_data, 1));
        void* buff = malloc(size);
        std::optional<std::size_t> bytes = stream->read(buff, size);
        if (!bytes.has_value()) RETURN_NULL();
        RETURN_STRINGL(static_cast<char*>(buff), bytes.value());
    }
    ZEND_DLEXPORT void inputstream_seek(zend_execute_data *execute_data, zval *return_value) {
        long position = Z_LVAL_P(ZEND_CALL_ARG(execute_data, 1));
        auto stream = storage_get<sf::InputStream>(execute_data);
        std::optional<std::size_t> ret = stream->seek(position);
        if (!ret.has_value()) RETURN_NULL();
        RETURN_LONG(ret.value());
    }
    ZEND_DLEXPORT void inputstream_tell(zend_execute_data *execute_data, zval *return_value) {
        auto stream = storage_get<sf::InputStream>(execute_data);
        std::optional<std::size_t> ret = stream->tell();
        if (!ret.has_value()) RETURN_NULL();
        RETURN_LONG(ret.value());
    }
    ZEND_DLEXPORT void inputstream_size(zend_execute_data *execute_data, zval *return_value) {
        auto stream = storage_get<sf::InputStream>(execute_data);
        std::optional<std::size_t> ret = stream->getSize();
        if (!ret.has_value()) RETURN_NULL();
        RETURN_LONG(ret.value());
    }
    ZEND_DLEXPORT void inputstream_destruct(zend_execute_data *execute_data, zval *return_value) {
        storage_remove<sf::InputStream>(execute_data);
    }
}