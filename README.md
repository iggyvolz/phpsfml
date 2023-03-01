Bindings of [SFML](https://sfml-dev.org) for PHP using FFI (no extensions needed!).

## How to use
*TODO: expand this out and provide actual examples*

- Obtain the CSFML binaries for your platform (https://github.com/SFML/CSFML)
- Create an AudioLib, GraphicsLib, NetworkLib, SystemLib, or WindowLib object with the path of the appropriate `.so` (Linux), `.dylib` (Mac) or `.dll` (Windows) library file
- Call functions and have fun!  Make sure to stay away from `@internal` stuff - there be ~~demons~~ implementation details!

## High level todos
- Make sure everything is marked as `@internal` if for internal use
- Provide a full demo w/ instructions on how to run

## APIs
### Audio
Not yet started.
### Graphics
Not yet started.

Not sure how OpenGL is handled here - need to dig deeper once I get to it.  Might skip for right now or try and link up with some other OpenGL binding if one exists.  From my understanding it's possible to do all the "SFML-y" things without OpenGL so it might make sense to just provide an endpoint for an OpenGL context.
### Network
Not yet started.

Of dubious use in PHP, which already has countless networking libraries.  Will probably do this one last or as a completion exercise.

### System
Done!

Thread support is... ah heck it segfaults instantly (as I expected).  Might come back and debug this at some point but the code is all there if you want to try.

### Window
Started on this one.  We can make a window!!!


## Status
Per-Header status (14/69):
- [ ] Network/IpAddress.h (15 SLOC)
- [ ] Network/SocketStatus.h (8 SLOC)
- [ ] Network/SocketSelector.h (14 SLOC)
- [ ] Network/Types.h (12 SLOC)
- [ ] Network/TcpSocket.h (14 SLOC)
- [ ] Network/Http.h (56 SLOC)
- [ ] Network/TcpListener.h (7 SLOC)
- [ ] Network/Ftp.h (95 SLOC)
- [ ] Network/UdpSocket.h (12 SLOC)
- [ ] Network/Packet.h (31 SLOC)
- [x] Window/WindowHandle.h (7 SLOC)
- [ ] Window/Touch.h (2 SLOC)
- [ ] Window/Event.h (124 SLOC) - Partially
- [x] Window/Clipboard.h (4 SLOC)
- [x] Window/Types.h (3 SLOC)
- [ ] Window/Mouse.h (17 SLOC)
- [ ] Window/JoystickIdentification.h (6 SLOC)
- [ ] Window/Sensor.h (13 SLOC)
- [ ] Window/Window.h (54 SLOC - Parially
- [x] Window/Context.h (8 SLOC)
- [ ] Window/Cursor.h (19 SLOC)
- [ ] Window/Joystick.h (24 SLOC)
- [x] Window/VideoMode.h (9 SLOC)
- [ ] Window/Keyboard.h (114 SLOC)
- [ ] Graphics/RectangleShape.h (32 SLOC)
- [ ] Graphics/RenderTexture.h (37 SLOC)
- [ ] Graphics/RenderStates.h (8 SLOC)
- [ ] Graphics/RenderWindow.h (57 SLOC)
- [ ] Graphics/Color.h (23 SLOC)
- [ ] Graphics/View.h (16 SLOC)
- [ ] Graphics/Vertex.h (6 SLOC)
- [ ] Graphics/VertexBuffer.h (20 SLOC)
- [ ] Graphics/Texture.h (33 SLOC)
- [ ] Graphics/Sprite.h (24 SLOC)
- [ ] Graphics/BlendMode.h (32 SLOC)
- [ ] Graphics/Types.h (16 SLOC)
- [ ] Graphics/Rect.h (18 SLOC)
- [ ] Graphics/CircleShape.h (33 SLOC)
- [ ] Graphics/Glyph.h (6 SLOC)
- [ ] Graphics/Glsl.h (49 SLOC)
- [ ] Graphics/Shader.h (42 SLOC)
- [ ] Graphics/Transform.h (19 SLOC)
- [ ] Graphics/VertexArray.h (11 SLOC)
- [ ] Graphics/ConvexShape.h (32 SLOC)
- [ ] Graphics/Transformable.h (16 SLOC)
- [ ] Graphics/PrimitiveType.h (13 SLOC)
- [ ] Graphics/Text.h (50 SLOC)
- [ ] Graphics/FontInfo.h (4 SLOC)
- [ ] Graphics/Font.h (12 SLOC)
- [ ] Graphics/Image.h (17 SLOC)
- [ ] Graphics/Shape.h (35 SLOC)
- [x] System/Vector2.h (15 SLOC)
- [x] System/Vector3.h (6 SLOC)
- [x] System/Clock.h (5 SLOC)
- [x] System/Sleep.h (1 SLOC)
- [x] System/Types.h (3 SLOC)
- [x] System/Thread.h (5 SLOC)
- [x] System/Mutex.h (4 SLOC)
- [x] System/InputStream.h (12 SLOC)
- [x] System/Time.h (11 SLOC)
- [ ] Audio/Music.h (34 SLOC)
- [ ] Audio/SoundRecorder.h (19 SLOC)
- [ ] Audio/Types.h (6 SLOC)
- [ ] Audio/Listener.h (8 SLOC)
- [ ] Audio/SoundStatus.h (6 SLOC)
- [ ] Audio/SoundBuffer.h (12 SLOC)
- [ ] Audio/Sound.h (25 SLOC)
- [ ] Audio/SoundStream.h (35 SLOC)
- [ ] Audio/SoundBufferRecorder.h (8 SLOC)