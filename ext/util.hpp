#pragma once
#include <php.h>
#include <string>
#include <typeinfo>
#include <variant>
#include<iostream>
#include<zend_enum.h>

void storage_put(uint32_t object_id, const std::type_info& type, void* data);
void storage_put(uint32_t object_id, const std::type_info& type, const void* data);
void* storage_get(uint32_t object_id, const std::type_info& type);
const void* storage_get_const(uint32_t object_id, const std::type_info& type);
void* storage_remove(uint32_t object_id, const std::type_info& type);

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
const T* storage_get_const(uint32_t object_id) {
    return static_cast<const T*>(storage_get_const(object_id, typeid(T)));
}
template<typename T>
const T* storage_get_const(zval zval) {
    return storage_get_const<T>(Z_OBJ_HANDLE(zval));
}
template<typename T>
const T* storage_get_const(zval* zval) {
    return storage_get_const<T>(Z_OBJ_HANDLE_P(zval));
}
template<typename T>
const T* storage_get_const(zend_execute_data* execute_data) {
    return storage_get_const<T>(execute_data->This);
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
    if (zend_class_entry* ce = zend_lookup_class_ex(str, nullptr, ZEND_FETCH_CLASS_EXCEPTION); ce != nullptr) {
        object_init_ex(zval, ce);
    } else {
        std::cout << "Failed to load class " << classname << std::endl;
    }
    storage_put(zval, data);
}
template<typename T>
void storage_new(zval* zval, const std::string& classname, const T* data) {
    zend_string* str = zend_string_init(classname.c_str(), classname.size(), false);
    if (zend_class_entry* ce = zend_lookup_class_ex(str, nullptr, ZEND_FETCH_CLASS_EXCEPTION); ce != nullptr) {
        object_init_ex(zval, ce);
    } else {
        std::cout << "Failed to load class " << classname << std::endl;
    }
    storage_put(zval, data);
}
inline void enum_get(zval* val, const std::string& classname, const std::variant<std::string, zend_long>& value) {
    zend_string* str = zend_string_init(classname.c_str(), classname.size(), false);
    zend_class_entry* ce;
    if (ce = zend_lookup_class_ex(str, nullptr, ZEND_FETCH_CLASS_EXCEPTION); ce == nullptr) {
        std::cout << "Failed to load class " << classname << std::endl;
        ZVAL_NULL(val);
        return;
    }
    zend_object* o;
    if (std::holds_alternative<zend_long>(value)) {
        zend_long long_value = std::get<zend_long>(value);
        if (zend_enum_get_case_by_value(&o, ce, long_value, nullptr, false) == SUCCESS) {
            ZVAL_OBJ(val, o);
        } else {
            std::cout << "Exception in getting case " << long_value << " from class " << classname << std::endl;
            exit(1);
        }
    } else {
        std::string name = std::get<std::string>(value);
        zend_string *name_str = zend_string_init(name.c_str(), name.size(), false);
        if (zend_enum_get_case_by_value(&o, ce, 0, name_str, false) == SUCCESS) {
            ZVAL_OBJ(val, o);
        } else {
            std::cout << "Exception in getting case " << name << " from class " << classname << std::endl;
            exit(1);
        }
        zend_string_release(name_str);
    }
}
