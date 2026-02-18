#include <complex>
#include <iostream>

#include "php.h"
#include "zend_exceptions.h"
#include <SFML/Window.hpp>

#include "../util.hpp"


extern "C" {
    ZEND_DLEXPORT void vulkan_isAvailable(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        RETURN_BOOL(sf::Vulkan::isAvailable());
    }
    ZEND_DLEXPORT void vulkan_getGraphicsRequiredInstanceExtensions(zend_execute_data *execute_data, zval *return_value) {
        if(zend_parse_parameters_none() != SUCCESS) return;
        array_init(return_value);
        for (auto extension : sf::Vulkan::getGraphicsRequiredInstanceExtensions()) {
            add_next_index_string(return_value, extension);
        }
    }
}