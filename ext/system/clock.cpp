#include <complex>
#include <iostream>
#include <map>

#include "php.h"
#include "zend_exceptions.h"
#include <SFML/System.hpp>
#include "time.hpp"
#include "../util.hpp"
static std::map<uint32_t, sf::Clock> clocks;
extern "C" {
    ZEND_DLEXPORT void clock_create(zend_execute_data *execute_data, zval *return_value) {
        new_object(R"(iggyvolz\SFML\System\Clock)", return_value);
        clocks[Z_OBJ_HANDLE_P(return_value)] = sf::Clock();
    }
    ZEND_DLEXPORT void clock_elapsedTime(zend_execute_data *execute_data, zval *return_value) {
        const sf::Clock& clock = clocks[Z_OBJ_HANDLE(execute_data->This)];
        new_time(clock.getElapsedTime(), return_value);
    }
    ZEND_DLEXPORT void clock_restart(zend_execute_data *execute_data, zval *return_value) {
        sf::Clock& clock = clocks[Z_OBJ_HANDLE(execute_data->This)];
        new_time(clock.restart(), return_value);
    }
    ZEND_DLEXPORT void clock_destruct(zend_execute_data *execute_data, zval *return_value) {
        clocks.erase(Z_OBJ_HANDLE(execute_data->This));
    }
}