<?php

use iggyvolz\SFML\Audio\Music;
use iggyvolz\SFML\Graphics\Font;
use iggyvolz\SFML\Graphics\RenderWindow;
use iggyvolz\SFML\Graphics\Sprite;
use iggyvolz\SFML\Graphics\Text;
use iggyvolz\SFML\Graphics\Texture;
use iggyvolz\SFML\Sfml;
use iggyvolz\SFML\Window\Event\ClosedEvent;
use iggyvolz\SFML\Window\VideoMode;

require_once __DIR__ . "/vendor/autoload.php";
$sfml = new Sfml(
    __DIR__ . "/../CSFML/lib/libcsfml-audio.so",
    __DIR__ . "/../CSFML/lib/libcsfml-graphics.so",
    __DIR__ . "/../CSFML/lib/libcsfml-network.so",
    __DIR__ . "/../CSFML/lib/libcsfml-system.so",
    __DIR__ . "/../CSFML/lib/libcsfml-window.so",
);
$window = RenderWindow::create(
    $sfml, "SFML window",
    VideoMode::create($sfml, 800, 600)
);
$texture = Texture::createFromFile($sfml, __DIR__ . "/../phpsfml_/demo/cute_image.jpg") ?? throw new RuntimeException();
$sprite = Sprite::create($sfml) ?? throw new RuntimeException();
$sprite->setTexture($texture, true);
$font = Font::createFromFile($sfml, __DIR__ . "/../phpsfml_/demo/arial.ttf") ?? throw new RuntimeException();
$text = Text::create($sfml) ?? throw new RuntimeException();
$text->setString("Hello SFML");
$text->setFont($font);
$text->setCharacterSize(50);
$music = Music::createFromFile($sfml, __DIR__ . "/../phpsfml_/demo/nice_music.ogg") ?? throw new RuntimeException();
$music->play(); // turn volume down to uncomment
while($window->isOpen()) {
    if($event = $window->pollEvent()) {
        if($event instanceof ClosedEvent) {
            $window->close();
        }
    }
    $window->clear();
    $window->draw($sprite);
    $window->draw($text);
    $window->display();
}
