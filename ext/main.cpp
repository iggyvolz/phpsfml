#include <iostream>

#include "php.h"



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
