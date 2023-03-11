<?php

use iggyvolz\SFML\Audio\AudioLib;
use iggyvolz\SFML\Audio\Music;
use iggyvolz\SFML\Event\ClosedEvent;
use iggyvolz\SFML\Graphics\Font;
use iggyvolz\SFML\Graphics\GraphicsLib;
use iggyvolz\SFML\Graphics\RenderWindow;
use iggyvolz\SFML\Graphics\Sprite;
use iggyvolz\SFML\Graphics\Text;
use iggyvolz\SFML\Graphics\Texture;
use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\Window\VideoMode;
use iggyvolz\SFML\Window\WindowLib;
use League\Event\EventDispatcher;
use League\Event\ListenerRegistry;
use Revolt\EventLoop;

require_once __DIR__ . "/vendor/autoload.php";
$systemLib = new SystemLib(__DIR__ . "/CSFML/lib/libcsfml-system.so");
$windowLib = new WindowLib(__DIR__ . "/CSFML/lib/libcsfml-window.so");
$graphicsLib = new GraphicsLib(__DIR__ . "/CSFML/lib/libcsfml-graphics.so");
$audioLib = new AudioLib(__DIR__ . "/CSFML/lib/libcsfml-audio.so");
$window = RenderWindow::create(
    $graphicsLib, $windowLib, "SFML window",
    VideoMode::create($windowLib, 800, 600),
    eventDispatcher: $listener = new EventDispatcher()
);
$texture = Texture::createFromFile($graphicsLib, __DIR__ . "/demo/cute_image.jpg") ?? throw new RuntimeException();
$sprite = Sprite::create($graphicsLib) ?? throw new RuntimeException();
$sprite->setTexture($texture, true);
$font = Font::createFromFile($graphicsLib, __DIR__ . "/demo/arial.ttf") ?? throw new RuntimeException();
$text = Text::create($graphicsLib) ?? throw new RuntimeException();
$text->setString("Hello SFML");
$text->setFont($font);
$text->setCharacterSize(50);
$music = Music::createFromFile($audioLib, __DIR__ . "/demo/nice_music.ogg") ?? throw new RuntimeException();
$music->play();
/** @var ListenerRegistry $listener */
$listener->subscribeTo(ClosedEvent::class, function(ClosedEvent $e): void {
    $e->window->close();
});
EventLoop::repeat(1/60, function(string $id) use($text, $sprite, $window) {
    if(!$window->isOpen()) {
        EventLoop::cancel($id);
    }
    $window->clear();
    $window->draw($sprite);
    $window->draw($text);
    $window->display();
});
EventLoop::run();