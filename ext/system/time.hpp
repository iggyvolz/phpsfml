#pragma once
#include <SFML/System/Time.hpp>
zval new_time(sf::Time time);
void new_time(sf::Time time, zval* obj);