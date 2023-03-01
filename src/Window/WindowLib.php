<?php

namespace iggyvolz\SFML\Window;
use FFI;
use iggyvolz\SFML\System\SystemLib;
use iggyvolz\SFML\System\Time;
use iggyvolz\SFML\Utils\UTF32;

readonly class WindowLib
{
    public FFI $ffi;
    public function __construct(string $libPath)
    {
        $this->ffi = FFI::cdef(file_get_contents(__DIR__ . "/Window.h"), $libPath);
    }

    /**
     * Get the content of the clipboard as string data (returns a Unicode string)
     * This function returns the content of the clipboard
     * as a string. If the clipboard does not contain string
     * it returns an empty string.
     * @return string Clipboard contents as UTF-32
     */
    private function getClipboardUtf32(): string
    {
        $str = $this->ffi->sfClipboard_getUnicodeString();
        $length = 0;
        while($str[$length] !== 0) {
            $length++;
        }

        return FFI::string(FFI::cast("char*", $str), ($length) * 4);
    }


    /**
     * Get the content of the clipboard as string data
     * This function returns the content of the clipboard
     * as a string. If the clipboard does not contain string
     * it returns an empty string.
     * @param string $encoding Desired encoding to return the string in
     * @return string Clipboard contents in the desired encoding
     */
    public function getClipboard(string $encoding = "UTF-8"): string
    {
        return (new UTF32($this->ffi->sfClipboard_getUnicodeString()))->toString($encoding);
    }


    /**
     * Set the content of the clipboard
     *
     * May not work due to OS restrictions unless a window is focused
     * @param string $text String containing the data to be sent to the clipboard
     * @param string $encoding Encoding of the string
     * @return void
     */
    public function setClipboard(string $text, string $encoding = "UTF-8"): void
    {
        $this->ffi->sfClipboard_setUnicodeString(UTF32::fromString($text, $encoding)->cdata);
    }
}
