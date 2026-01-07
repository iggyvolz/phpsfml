#include <iostream>
#include <map>
#include <typeindex>
#include <variant>

#include "php.h"

static std::map<std::type_index, std::map<zend_long, std::variant<void*, const void*>>> storage;

void storage_put(uint32_t object_id, const std::type_info& type, void* data) {
    storage[type][object_id] = data;
}
void storage_put(uint32_t object_id, const std::type_info& type, const void* data) {
    storage[type][object_id] = data;
}
void* storage_get(uint32_t object_id, const std::type_info& type) {
    if (!storage[type].contains(object_id)) {
        return nullptr;
    }
    if (std::holds_alternative<void*>(storage[type][object_id])) {
        return std::get<void*>(storage[type][object_id]);
    }
    return const_cast<void*>(std::get<const void*>(storage[type][object_id]));
}
void* storage_remove(uint32_t object_id, const std::type_info& type) {
    if (!storage[type].contains(object_id)) {
        return nullptr;
    }
    void* obj = nullptr;
    if (std::holds_alternative<void*>(storage[type][object_id])) {
        obj = std::get<void*>(storage[type][object_id]);
    }
    storage[type].erase(object_id);
    return obj;
}

extern "C" {
#ifndef ZEND_DEBUG
#define ZEND_DEBUG 0
#endif
static zend_module_entry module_entry = {
    .size = sizeof(zend_module_entry),
    .zend_api = ZEND_MODULE_API_NO,
    .zend_debug = ZEND_DEBUG,
    .zts = USING_ZTS,
    .name = "phpsfml",
    .version = "0.0.0",
    .build_id = ZEND_MODULE_BUILD_ID,
};
    ZEND_DLEXPORT zend_module_entry *get_module(void) {
        return &module_entry;
    }
}
