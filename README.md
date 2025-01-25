# Custom Base 64

A PHP package for customizable Base64 encoding and decoding with support for custom character sets and optional reversed output.

## Features
- Customizable Base64 character sets.
- Optional reversed output for encoding/decoding. 

## Requirements

PHP 8+

## Installation

1. Use the library via Composer:

```
composer require edgaras/custombase64
```

2. Include the Composer autoloader:

```php
require __DIR__ . '/vendor/autoload.php';
```

## Usage

### 1. Initialization

You can initialize the `CustomBase64` class with optional parameters:

```php
use Edgaras\CustomBase64\CustomBase64;

// Default initialization
$base64 = new CustomBase64();

// Custom charset and reversed output
$customChars = 'TPUQVRWXSYZABCDENOFGHIJKLMnopqrstuvwxyzabcdefghijklm0123456789+-';
$reverseOutput = true;
$base64 = new CustomBase64($customChars, $reverseOutput);
```

### 2. Encoding data

Use the `encode` method to convert data into custom Base64 format:

```php
$data = "Hello, CustomBase64!";
$encoded = $base64->encode($data);
echo "Encoded: " . $encoded;
// Example output: "=VUC2H2puYHoiO3p1CVSf8WofIWF"
```

### 3. Decoding Data

Decode Base64-encoded strings back to their original form using the `decode` method:

```php
$encoded = "=VUC2H2puYHoiO3p1CVSf8WofIWF";
$decoded = $base64->decode($encoded);
echo "Decoded: " . $decoded;
// Example output: "Hello, CustomBase64!"
```