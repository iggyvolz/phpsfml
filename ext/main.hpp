#pragma once
#include <map>
#include <php.h>
void storage_put(uint32_t object_id, const std::type_info& type, void* data);
void storage_put(uint32_t object_id, const std::type_info& type, const void* data);
void* storage_get(uint32_t object_id, const std::type_info& type);
bool storage_remove(uint32_t object_id, const std::type_info& type);

template<typename T>
void storage_put(uint32_t object_id, T* data) {
    storage_put(object_id, typeid(T), data);
}
template<typename T>
void storage_put(zval zval, T* data) {
    storage_put(Z_OBJ_HANDLE(zval), data);
}
template<typename T>
void storage_put(zval* zval, T* data) {
    storage_put(Z_OBJ_HANDLE_P(zval), data);
}
template<typename T>
void storage_put(zend_execute_data* execute_data, T* data) {
    storage_put(Z_OBJ_HANDLE(execute_data->This), data);
}
template<typename T>
void storage_put(uint32_t object_id, const T* data) {
    storage_put(object_id, typeid(T), data);
}
template<typename T>
void storage_put(zval zval, const T* data) {
    storage_put(Z_OBJ_HANDLE(zval), data);
}
template<typename T>
void storage_put(zval* zval, const T* data) {
    storage_put(Z_OBJ_HANDLE_P(zval), data);
}
template<typename T>
void storage_put(zend_execute_data* execute_data, const T* data) {
    storage_put(Z_OBJ_HANDLE(execute_data->This), data);
}
template<typename T>
T* storage_get(uint32_t object_id) {
    return static_cast<T*>(storage_get(object_id, typeid(T)));
}
template<typename T>
T* storage_get(zval zval) {
    return storage_get<T>(Z_OBJ_HANDLE(zval));
}
template<typename T>
T* storage_get(zval* zval) {
    return storage_get<T>(Z_OBJ_HANDLE_P(zval));
}
template<typename T>
T* storage_get(zend_execute_data* execute_data) {
    return storage_get<T>(execute_data->This);
}
template<typename T>
void storage_remove(uint32_t object_id) {
    void* ptr = storage_remove(object_id, typeid(T));
    if (ptr != nullptr) {
        delete static_cast<T*>(ptr);
    }
}
template<typename T>
void storage_remove(zval zval) {
    storage_remove<T>(Z_OBJ_HANDLE(zval));
}
template<typename T>
void storage_remove(zval* zval) {
    storage_remove<T>(Z_OBJ_HANDLE_P(zval));
}
template<typename T>
void storage_remove(zend_execute_data* execute_data) {
    storage_remove<T>(execute_data->This);
}
template<typename T>
void storage_new(zval* zval, const std::string& classname, T* data) {
    zend_string* str = zend_string_init(classname.c_str(), classname.size(), false);
    zend_class_entry* ce = zend_lookup_class(str);
    object_init_ex(zval, ce);
    storage_put(zval, data);
}