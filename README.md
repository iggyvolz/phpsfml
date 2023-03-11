Bindings of [SFML](https://sfml-dev.org) for PHP using FFI (no custom extensions needed!).

## How to use
*TODO: expand this out and provide actual examples*

- Obtain the CSFML binaries for your platform (https://github.com/SFML/CSFML)
- Create an AudioLib, GraphicsLib, SystemLib, or WindowLib object with the path of the appropriate `.so` (Linux), `.dylib` (Mac) or `.dll` (Windows) library file
- Call functions and have fun!  Make sure to stay away from `@internal` stuff - there be ~~demons~~ implementation details!

## High level todos
- Provide a full demo w/ instructions on how to run
- Make abstract classes for C objects - cleans up some of the __construct copy-pasta
- Establish patterns for C-object-to-pointer vs C-object-to-struct (rough: go to pointer if there is a create and delete method, and/or if you only get a pointer returned on create)
- Autogenerate most code from C (long-term pipe dream)

### Fixing the cross-library struct problem

PHP's getting mad if I pass pointers between libs without recasting them. 

Fix (maybe):
- Libraries connected via a traversable SFML object
- Private struct constructors and cdata (would fix @internal problem too)
- Where needed, provide explicit CreateFromSystem, CreateFromGraphics libs (when outside correct library, perform a one-time cast)

This could probably be fixed by providing base classes with this functionality: BaseStruct => {BaseStructSystem, BaseStructWindow} and BaseObject => {BaseObjectSystem, BaseObjectWindow}
## APIs
### Audio
Almost done.

See explanation below for Shape.h for SoundStream.h.

### Graphics
Done!

Need to backport comments on some of the classes - got lazy on some of them here.

Draw functions are in Drawable classes rather than in RenderWindow/RenderTarget.

Not porting functions from Shape.h for now - this is for making a custom Shape "subclass" - this is an edge case and would be a bit funky translating to PHP.

Very possible I missed a couple things in here.

### Network
Not planning to port this one.  PHP has much better native networking capabilities, and the system in SFML is inherently limited.

### System
Done!

Threading and mutexes are not supported as PHP does tons of ugly things with parallellism and it segfaults instantly.  Might want to look at the parallel extension instead.

### Window
Done!

Definitely needs a lot of testing, probably made some typos here.

## Status

[//]: # (Number of done files: cat README.md |grep '^- \[x'|wc -l)
[//]: # (Total number of files: cat README.md |grep '^- \['|wc -l)
[//]: # (Number of done lines: cat README.md |grep '^- \[x'|awk -F\( '{print $2}'|awk '{print $1}'|paste -sd+|bc)
[//]: # (Total number of lines: cat README.md |grep '^- \['|awk -F\( '{print $2}'|awk '{print $1}'|paste -sd+|bc)
Per-Header status (3.5/4 systems - 56/59 files - 1241/1280 SLOC):
- [x] Window/WindowHandle.h (7 SLOC)
- [x] Window/Touch.h (2 SLOC)
- [x] Window/Event.h (124 SLOC)
- [x] Window/Clipboard.h (4 SLOC)
- [x] Window/Types.h (3 SLOC)
- [x] Window/Mouse.h (17 SLOC)
- [x] Window/JoystickIdentification.h (6 SLOC)
- [x] Window/Sensor.h (13 SLOC)
- [x] Window/Window.h (54 SLOC
- [x] Window/Context.h (8 SLOC)
- [x] Window/Cursor.h (19 SLOC)
- [x] Window/Joystick.h (24 SLOC)
- [x] Window/VideoMode.h (9 SLOC)
- [x] Window/Keyboard.h (114 SLOC)
- [x] Graphics/RectangleShape.h (32 SLOC)
- [x] Graphics/RenderTexture.h (37 SLOC)
- [x] Graphics/RenderStates.h (8 SLOC)
- [x] Graphics/RenderWindow.h (57 SLOC)
- [x] Graphics/Color.h (23 SLOC)
- [x] Graphics/View.h (16 SLOC)
- [x] Graphics/Vertex.h (6 SLOC)
- [x] Graphics/VertexBuffer.h (20 SLOC)
- [x] Graphics/Texture.h (33 SLOC)
- [x] Graphics/Sprite.h (24 SLOC)
- [x] Graphics/BlendMode.h (32 SLOC)
- [x] Graphics/Types.h (16 SLOC)
- [x] Graphics/Rect.h (18 SLOC)
- [x] Graphics/CircleShape.h (33 SLOC)
- [x] Graphics/Glyph.h (6 SLOC)
- [x] Graphics/Glsl.h (49 SLOC)
- [x] Graphics/Shader.h (42 SLOC)
- [x] Graphics/Transform.h (19 SLOC)
- [x] Graphics/VertexArray.h (11 SLOC)
- [x] Graphics/ConvexShape.h (32 SLOC)
- [x] Graphics/Transformable.h (16 SLOC)
- [x] Graphics/PrimitiveType.h (13 SLOC)
- [x] Graphics/Text.h (50 SLOC)
- [x] Graphics/FontInfo.h (4 SLOC)
- [x] Graphics/Font.h (12 SLOC)
- [x] Graphics/Image.h (17 SLOC)
- [x] Graphics/Shape.h (35 SLOC)
- [x] System/Vector2.h (15 SLOC)
- [x] System/Vector3.h (6 SLOC)
- [x] System/Clock.h (5 SLOC)
- [x] System/Sleep.h (1 SLOC)
- [x] System/Types.h (3 SLOC)
- [x] System/Thread.h (5 SLOC)
- [x] System/Mutex.h (4 SLOC)
- [x] System/InputStream.h (12 SLOC)
- [x] System/Time.h (11 SLOC)
- [x] Audio/Music.h (34 SLOC)
- [ ] Audio/SoundRecorder.h (19 SLOC)
- [x] Audio/Types.h (6 SLOC)
- [x] Audio/Listener.h (8 SLOC)
- [x] Audio/SoundStatus.h (6 SLOC)
- [ ] Audio/SoundBuffer.h (12 SLOC)
- [x] Audio/Sound.h (25 SLOC)
- [x] Audio/SoundStream.h (35 SLOC)
- [ ] Audio/SoundBufferRecorder.h (8 SLOC)