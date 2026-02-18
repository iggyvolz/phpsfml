cmake_minimum_required(VERSION 4.2)
project(phpsfml)

set(CMAKE_CXX_STANDARD 26)
set(CMAKE_POSITION_INDEPENDENT_CODE ON)
#add_compile_options(-O0 -g -fno-omit-frame-pointer -fno-optimize-sibling-calls -fsanitize=address,undefined)
#add_link_options(-fsanitize=address,undefined)
set(CMAKE_POSITION_INDEPENDENT_CODE ON)  # affects everything built after this
include(FetchContent)
FetchContent_Declare(
        SFML
        GIT_REPOSITORY https://github.com/SFML/SFML.git
        GIT_TAG 3.0.2
)
FetchContent_MakeAvailable(SFML)

set(PHP_ROOT CACHE PATH "Path to PHP installation directory")

include_directories(
        ${PHP_ROOT}/include/php
        ${PHP_ROOT}/include/php/main
        ${PHP_ROOT}/include/php/TSRM
        ${PHP_ROOT}/include/php/Zend
        ${PHP_ROOT}/include/php/ext
        ${PHP_ROOT}/include/php/ext/date/lib
        ${PHP_ROOT}/include
        ${PHP_ROOT}/include/main
        ${PHP_ROOT}/include/TSRM
        ${PHP_ROOT}/include/Zend
        ${PHP_ROOT}/include/ext
        ${PHP_ROOT}/include/ext/date/lib
)

if (WIN32)
    link_directories(${PHP_ROOT}/lib)
endif ()
add_library(phpsfml SHARED main.cpp system/time.cpp system/clock.cpp
        system/input_stream.cpp
        system/vector2f.cpp
        system/vector2i.cpp
        system/vector2u.cpp
        system/vector3f.cpp
        window/videomode.cpp
        window/windowbase.cpp
        window/event.cpp
        window/event.hpp
        system/angle.cpp
        system/string.cpp
        window/contextSettings.cpp
        window/context.cpp
        window/cursor.cpp
        window/clipboard.cpp
        window/joystick.cpp
        window/keyboard.cpp
        window/mouse.cpp
        window/sensor.cpp
        window/touch.cpp
        window/vulkan.cpp)
if(WIN32)
    target_compile_definitions(phpsfml PRIVATE ZEND_WIN32 PHP_WIN32)
    target_link_libraries(phpsfml PRIVATE php8)
endif()
target_link_libraries(phpsfml PRIVATE SFML::System SFML::Window)