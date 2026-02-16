#include "event.hpp"
extern "C" {
    ZEND_DLEXPORT void resizedevent_getwidth(zend_execute_data *execute_data, zval *return_value) {
        RETURN_LONG(storage_get_const<sf::Event::Resized>(execute_data)->size.x);
    }
    ZEND_DLEXPORT void resizedevent_getheight(zend_execute_data *execute_data, zval *return_value) {
        RETURN_LONG(storage_get_const<sf::Event::Resized>(execute_data)->size.y);
    }
    ZEND_DLEXPORT void textentered_unicode(zend_execute_data *execute_data, zval *return_value) {
        RETURN_LONG(storage_get_const<sf::Event::TextEntered>(execute_data)->unicode);
    }
    ZEND_DLEXPORT void keypressed_getcode(zend_execute_data *execute_data, zval *return_value) {
        enum_get(return_value, R"(iggyvolz\SFML\Window\Key)", static_cast<zend_long>(storage_get_const<sf::Event::KeyPressed>(execute_data)->code));
    }
    ZEND_DLEXPORT void keypressed_getscancode(zend_execute_data *execute_data, zval *return_value) {
        enum_get(return_value, R"(iggyvolz\SFML\Window\Key)", static_cast<zend_long>(storage_get_const<sf::Event::KeyPressed>(execute_data)->scancode));
    }
    ZEND_DLEXPORT void keypressed_getalt(zend_execute_data *execute_data, zval *return_value) {
        RETURN_BOOL(storage_get_const<sf::Event::KeyPressed>(execute_data)->alt);
    }
    ZEND_DLEXPORT void keypressed_getcontrol(zend_execute_data *execute_data, zval *return_value) {
        RETURN_BOOL(storage_get_const<sf::Event::KeyPressed>(execute_data)->control);
    }
    ZEND_DLEXPORT void keypressed_getshift(zend_execute_data *execute_data, zval *return_value) {
        RETURN_BOOL(storage_get_const<sf::Event::KeyPressed>(execute_data)->shift);
    }
    ZEND_DLEXPORT void keypressed_getsystem(zend_execute_data *execute_data, zval *return_value) {
        RETURN_BOOL(storage_get_const<sf::Event::KeyPressed>(execute_data)->system);
    }
    ZEND_DLEXPORT void keyreleased_getcode(zend_execute_data *execute_data, zval *return_value) {
        enum_get(return_value, R"(iggyvolz\SFML\Window\Scan)", static_cast<zend_long>(storage_get_const<sf::Event::KeyReleased>(execute_data)->code));
    }
    ZEND_DLEXPORT void keyreleased_getscancode(zend_execute_data *execute_data, zval *return_value) {
        enum_get(return_value, R"(iggyvolz\SFML\Window\Scan)", static_cast<zend_long>(storage_get_const<sf::Event::KeyReleased>(execute_data)->scancode));
    }
    ZEND_DLEXPORT void keyreleased_getalt(zend_execute_data *execute_data, zval *return_value) {
        RETURN_BOOL(storage_get_const<sf::Event::KeyReleased>(execute_data)->alt);
    }
    ZEND_DLEXPORT void keyreleased_getcontrol(zend_execute_data *execute_data, zval *return_value) {
        RETURN_BOOL(storage_get_const<sf::Event::KeyReleased>(execute_data)->control);
    }
    ZEND_DLEXPORT void keyreleased_getshift(zend_execute_data *execute_data, zval *return_value) {
        RETURN_BOOL(storage_get_const<sf::Event::KeyReleased>(execute_data)->shift);
    }
    ZEND_DLEXPORT void keyreleased_getsystem(zend_execute_data *execute_data, zval *return_value) {
        RETURN_BOOL(storage_get_const<sf::Event::KeyReleased>(execute_data)->system);
    }
}