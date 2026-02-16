#include <iostream>
#include "php.h"
#include "zend_exceptions.h"
#include <SFML/System.hpp>
#include "../util.hpp"

extern "C" {
    ZEND_DLEXPORT void angle_degrees(zend_execute_data *execute_data, zval *return_value) {
        double amount;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &amount) != SUCCESS) return;
        const auto angle = new sf::Angle();
        *angle = sf::degrees(static_cast<float>(amount));
        storage_new(return_value, R"(iggyvolz\SFML\System\Angle)", angle);
    }
    ZEND_DLEXPORT void angle_radians(zend_execute_data *execute_data, zval *return_value) {
        double amount;
        if(zend_parse_parameters(ZEND_NUM_ARGS(), "d", &amount) != SUCCESS) return;
        const auto angle = new sf::Angle();
        *angle = sf::radians(static_cast<float>(amount));
        storage_new(return_value, R"(iggyvolz\SFML\System\Angle)", angle);
    }
    ZEND_DLEXPORT void angle_asDegrees(zend_execute_data *execute_data, zval *return_value) {
        auto angle = storage_get<sf::Angle>(execute_data);
        RETURN_DOUBLE(angle->asDegrees());
    }
    ZEND_DLEXPORT void angle_asRadians(zend_execute_data *execute_data, zval *return_value) {
        auto angle = storage_get<sf::Angle>(execute_data);
        RETURN_DOUBLE(angle->asRadians());
    }
    ZEND_DLEXPORT void angle_destruct(zend_execute_data *execute_data, zval *return_value) {
        storage_remove<sf::Angle>(execute_data);
    }
}
