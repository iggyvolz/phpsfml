#include <iostream>
#include <map>

#include "php.h"
#include "zend_exceptions.h"
#include <SFML/System.hpp>

#include "../main.hpp"

extern "C" {
    ZEND_DLEXPORT void time_zero(zend_execute_data *execute_data, zval *return_value) {
        storage_new(return_value, R"(iggyvolz\SFML\System\Time)", new sf::Time(sf::Time::Zero));
    }
    ZEND_DLEXPORT void time_asSeconds(zend_execute_data *execute_data, zval *return_value) {
        auto time = storage_get<sf::Time>(execute_data);
        RETURN_DOUBLE(time->asSeconds());
    }
    ZEND_DLEXPORT void time_asMilliseconds(zend_execute_data *execute_data, zval *return_value) {
        auto time = storage_get<sf::Time>(execute_data);
        RETURN_LONG(time->asMilliseconds());
    }
    ZEND_DLEXPORT void time_asMicroseconds(zend_execute_data *execute_data, zval *return_value) {
        auto time = storage_get<sf::Time>(execute_data);
        RETURN_LONG(time->asMicroseconds());
    }
    ZEND_DLEXPORT void time_fromSeconds(zend_execute_data *execute_data, zval *return_value) {
        double amount;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &amount) == SUCCESS);
        const auto duration = std::chrono::microseconds(static_cast<int64_t>(amount * 1000000));
        storage_new(return_value, R"(iggyvolz\SFML\System\Time)", new sf::Time(duration));
    }
    ZEND_DLEXPORT void time_fromMilliseconds(zend_execute_data *execute_data, zval *return_value) {
        zend_long amount;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "l", &amount) == SUCCESS);
        const auto duration = std::chrono::milliseconds(amount);
        storage_new(return_value, R"(iggyvolz\SFML\System\Time)", new sf::Time(duration));
    }
    ZEND_DLEXPORT void time_fromMicroseconds(zend_execute_data *execute_data, zval *return_value) {
        zend_long amount;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "l", &amount) == SUCCESS);
        const auto duration = std::chrono::microseconds(amount);
        storage_new(return_value, R"(iggyvolz\SFML\System\Time)", new sf::Time(duration));
    }
    ZEND_DLEXPORT void time_destruct(zend_execute_data *execute_data, zval *return_value) {
        storage_remove<sf::Time>(execute_data);
    }
    ZEND_DLEXPORT void time_sleep(zend_execute_data *execute_data, zval *return_value) {
        zval* time_obj;
        ZEND_ASSERT(zend_parse_parameters(ZEND_NUM_ARGS(), "o", &time_obj) == SUCCESS);
        auto time = storage_get<sf::Time>(time_obj);
        sf::sleep(*time);
    }
}