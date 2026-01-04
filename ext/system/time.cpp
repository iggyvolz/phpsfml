#include <iostream>
#include <map>

#include "php.h"
#include "zend_exceptions.h"
#include <SFML/System.hpp>
#include "../util.hpp"
#include "time.hpp"

static std::map<uint32_t, sf::Time> times;

zval new_time(const sf::Time time) {
    zval obj;
    new_time(time, &obj);
    return obj;
}

void new_time(const sf::Time time, zval* obj) {
    new_object(R"(iggyvolz\SFML\System\Time)", obj);
    times[Z_OBJ_HANDLE_P(obj)] = time;
}

extern "C" {
    ZEND_DLEXPORT void time_zero(zend_execute_data *execute_data, zval *return_value) {
        new_time(sf::Time::Zero, return_value);
    }
    ZEND_DLEXPORT void time_asSeconds(zend_execute_data *execute_data, zval *return_value) {
        const sf::Time time = times[Z_OBJ_HANDLE(execute_data->This)];
        RETURN_DOUBLE(time.asSeconds());
    }
    ZEND_DLEXPORT void time_asMilliseconds(zend_execute_data *execute_data, zval *return_value) {
        const sf::Time time = times[Z_OBJ_HANDLE(execute_data->This)];
        RETURN_LONG(time.asMilliseconds());
    }
    ZEND_DLEXPORT void time_asMicroseconds(zend_execute_data *execute_data, zval *return_value) {
        const sf::Time time = times[Z_OBJ_HANDLE(execute_data->This)];
        RETURN_LONG(time.asMicroseconds());
    }
    ZEND_DLEXPORT void time_fromSeconds(zend_execute_data *execute_data, zval *return_value) {
        double amount;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &amount) == SUCCESS);
        const auto duration = std::chrono::microseconds(static_cast<int64_t>(amount * 1000000));
        new_time(sf::Time(duration), return_value);
    }
    ZEND_DLEXPORT void time_fromMilliseconds(zend_execute_data *execute_data, zval *return_value) {
        zend_long amount;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "l", &amount) == SUCCESS);
        const auto duration = std::chrono::milliseconds(amount);
        new_time(sf::Time(duration), return_value);
    }
    ZEND_DLEXPORT void time_fromMicroseconds(zend_execute_data *execute_data, zval *return_value) {
        zend_long amount;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "l", &amount) == SUCCESS);
        const auto duration = std::chrono::microseconds(amount);
        new_time(sf::Time(duration), return_value);
    }
    ZEND_DLEXPORT void time_destruct(zend_execute_data *execute_data, zval *return_value) {
        times.erase(Z_OBJ_HANDLE(execute_data->This));
    }
    ZEND_DLEXPORT void time_sleep(zend_execute_data *execute_data, zval *return_value) {
        zval* time_obj;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "o", &time_obj) == SUCCESS);
        const sf::Time time = times[Z_OBJ_HANDLE_P(time_obj)];
        sf::sleep(time);
    }
}