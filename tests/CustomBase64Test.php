<?php

use PHPUnit\Framework\TestCase;
use Edgaras\CustomBase64\CustomBase64;

class CustomBase64Test extends TestCase
{
    /**
     * Test constructor with default parameters
     */
    public function testConstructorDefault()
    {
        $base64 = new CustomBase64();
        $this->assertInstanceOf(CustomBase64::class, $base64);
    }

    /**
     * Test constructor with custom character set
     */
    public function testConstructorCustomChars()
    {
        $customChars = 'TPUQVRWXSYZABCDENOFGHIJKLMnopqrstuvwxyzabcdefghijklm0123456789+-';
        $base64 = new CustomBase64($customChars);
        $this->assertInstanceOf(CustomBase64::class, $base64);
    }

    /**
     * Test constructor with invalid custom character set
     */
    public function testConstructorInvalidCustomChars()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Custom character set must be exactly 64 characters.");
        $base64 = new CustomBase64('short-alphabet');
    }

    /**
     * Test encoding regular strings
     */
    public function testEncodeRegularString()
    {
        $base64 = new CustomBase64();
        $data = "Hello, World!";
        $encoded = $base64->encode($data);
        $this->assertNotEmpty($encoded);
        $this->assertIsString($encoded);
    }

    /**
     * Test encoding with empty string
     */
    public function testEncodeEmptyString()
    {
        $base64 = new CustomBase64();
        $data = "";
        $encoded = $base64->encode($data);
        $this->assertSame("", $encoded);
    }

    /**
     * Test encoding with reversed output
     */
    public function testEncodeWithReversedOutput()
{
    $base64 = new CustomBase64(null, true);
    $data = "Test String";
    $encoded = $base64->encode($data);
    $expectedEncoded = strrev(strtr(base64_encode($data), 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/', 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_'));
    $this->assertSame($expectedEncoded, $encoded);
}


    /**
     * Test encoding binary data
     */
    public function testEncodeBinaryData()
    {
        $base64 = new CustomBase64();
        $data = pack('H*', '48656c6c6f2c20426f6e61727921');  
        $encoded = $base64->encode($data);
        $this->assertNotEmpty($encoded);
    }

    /**
     * Test decoding valid encoded string
     */
    public function testDecodeValidString()
    {
        $base64 = new CustomBase64();
        $data = "Hello, Decode!";
        $encoded = $base64->encode($data);
        $decoded = $base64->decode($encoded);
        $this->assertSame($data, $decoded);
    }

    /**
     * Test decoding empty string
     */
    public function testDecodeEmptyString()
    {
        $base64 = new CustomBase64();
        $decoded = $base64->decode("");
        $this->assertSame("", $decoded);
    }

    /**
     * Test decoding with reversed output
     */
    public function testDecodeWithReversedOutput()
    {
        $base64 = new CustomBase64(null, true);
        $data = "Reversed Decode";
        $encoded = $base64->encode($data);
        $decoded = $base64->decode($encoded);
        $this->assertSame($data, $decoded);
    }

    /**
     * Test decoding invalid encoded string
     */
    public function testDecodeInvalidString()
    {
        $base64 = new CustomBase64();
        $invalidEncoded = "InvalidBase64@@";
        $decoded = $base64->decode($invalidEncoded);
        $this->assertFalse($decoded);  
    }

    /**
     * Test custom character set preservation
     */
    public function testCustomCharacterSetPreservation()
    {
        $customChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+-';
        $base64 = new CustomBase64($customChars);
        
        $reflection = new \ReflectionClass($base64);
        $property = $reflection->getProperty('customChars');
        $property->setAccessible(true);
        $actualCustomChars = $property->getValue($base64);
        
        $this->assertSame($customChars, $actualCustomChars);
    }
}
