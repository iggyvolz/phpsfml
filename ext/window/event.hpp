#pragma once
#include<SFML/Window.hpp>
#include "../util.hpp"

#define RETURN_EVENT(x)  if (event.is<sf::Event::x>()) { storage_new(return_value, "iggyvolz\\SFML\\Window\\Event\\" #x "Event", new sf::Event::x(*event.getIf<sf::Event::x>())); return;}
#define RETURN_EVENTS() \
RETURN_EVENT(Closed) \
RETURN_EVENT(FocusGained) \
RETURN_EVENT(FocusLost) \
RETURN_EVENT(JoystickButtonPressed) \
RETURN_EVENT(JoystickButtonReleased) \
RETURN_EVENT(JoystickConnected) \
RETURN_EVENT(JoystickDisconnected) \
RETURN_EVENT(JoystickMoved) \
RETURN_EVENT(KeyPressed) \
RETURN_EVENT(KeyReleased) \
RETURN_EVENT(MouseButtonPressed) \
RETURN_EVENT(MouseButtonReleased) \
RETURN_EVENT(MouseEntered) \
RETURN_EVENT(MouseLeft) \
RETURN_EVENT(MouseMoved) \
RETURN_EVENT(MouseMovedRaw) \
RETURN_EVENT(MouseWheelScrolled) \
RETURN_EVENT(Resized) \
RETURN_EVENT(SensorChanged) \
RETURN_EVENT(TextEntered) \
RETURN_EVENT(TouchBegan) \
RETURN_EVENT(TouchEnded) \
RETURN_EVENT(TouchMoved)
