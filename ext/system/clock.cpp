#include <complex>
#include <iostream>
#include "php.h"
#include "zend_exceptions.h"
#include <SFML/System.hpp>
#include "../main.hpp"

extern "C" {
    ZEND_DLEXPORT void clock_construct(zend_execute_data *execute_data, zval *return_value) {
        storage_put(execute_data, new sf::Clock());
    }
    ZEND_DLEXPORT void clock_elapsedTime(zend_execute_data *execute_data, zval *return_value) {
        auto clock = storage_get<sf::Clock>(execute_data);
        storage_new(return_value, R"(iggyvolz\SFML\System\Time)", new sf::Time(clock->getElapsedTime()));
    }
    ZEND_DLEXPORT void clock_restart(zend_execute_data *execute_data, zval *return_value) {
        auto* clock = storage_get<sf::Clock>(execute_data);
        storage_new(return_value, R"(iggyvolz\SFML\System\Time)", new sf::Time(clock->restart()));
    }
    ZEND_DLEXPORT void clock_destruct(zend_execute_data *execute_data, zval *return_value) {
        storage_remove<sf::Clock>(execute_data);
    }
}
