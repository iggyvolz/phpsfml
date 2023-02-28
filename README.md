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
Not yet started.


## Status
Per-Header status (10/74):
- [ ] Network/IpAddress.h
- [ ] Network/SocketStatus.h
- [ ] Network/SocketSelector.h
- [ ] Network/Export.h
- [ ] Network/Types.h
- [ ] Network/TcpSocket.h
- [ ] Network/Http.h
- [ ] Network/TcpListener.h
- [ ] Network/Ftp.h
- [ ] Network/UdpSocket.h
- [ ] Network/Packet.h
- [ ] Window/WindowHandle.h
- [ ] Window/Touch.h
- [ ] Window/Event.h
- [ ] Window/Clipboard.h
- [ ] Window/Export.h
- [ ] Window/Types.h
- [ ] Window/Mouse.h
- [ ] Window/JoystickIdentification.h
- [ ] Window/Sensor.h
- [ ] Window/Window.h
- [ ] Window/Context.h
- [ ] Window/Cursor.h
- [ ] Window/Joystick.h
- [ ] Window/VideoMode.h
- [ ] Window/Keyboard.h
- [ ] Graphics/RectangleShape.h
- [ ] Graphics/RenderTexture.h
- [ ] Graphics/RenderStates.h
- [ ] Graphics/RenderWindow.h
- [ ] Graphics/Color.h
- [ ] Graphics/View.h
- [ ] Graphics/Vertex.h
- [ ] Graphics/VertexBuffer.h
- [ ] Graphics/Texture.h
- [ ] Graphics/Export.h
- [ ] Graphics/Sprite.h
- [ ] Graphics/BlendMode.h
- [ ] Graphics/Types.h
- [ ] Graphics/Rect.h
- [ ] Graphics/CircleShape.h
- [ ] Graphics/Glyph.h
- [ ] Graphics/Glsl.h
- [ ] Graphics/Shader.h
- [ ] Graphics/Transform.h
- [ ] Graphics/VertexArray.h
- [ ] Graphics/ConvexShape.h
- [ ] Graphics/Transformable.h
- [ ] Graphics/PrimitiveType.h
- [ ] Graphics/Text.h
- [ ] Graphics/FontInfo.h
- [ ] Graphics/Font.h
- [ ] Graphics/Image.h
- [ ] Graphics/Shape.h
- [x] System/Vector2.h
- [x] System/Vector3.h
- [x] System/Clock.h
- [x] System/Export.h
- [x] System/Sleep.h
- [x] System/Types.h
- [x] System/Thread.h
- [x] System/Mutex.h
- [x] System/InputStream.h
- [x] System/Time.h
- [ ] Audio/Music.h
- [ ] Audio/Export.h
- [ ] Audio/SoundRecorder.h
- [ ] Audio/Types.h
- [ ] Audio/Listener.h
- [ ] Audio/SoundStatus.h
- [ ] Audio/SoundBuffer.h
- [ ] Audio/Sound.h
- [ ] Audio/SoundStream.h
- [ ] Audio/SoundBufferRecorder.h