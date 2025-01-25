<?php

namespace Edgaras\CustomBase64;

class CustomBase64 {

    private $customChars;
    private $standardChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';  
    private $reverseOutput;

    public function __construct($customChars = null, $reverseOutput = false) {
    
        $this->customChars = $customChars ?? 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-_';
        if (strlen($this->customChars) !== 64) {
            throw new \InvalidArgumentException("Custom character set must be exactly 64 characters.");
        }
        $this->reverseOutput = $reverseOutput;
    }
 
    public function encode($data) {
        $standardEncoded = base64_encode($data);  
        $customEncoded = strtr($standardEncoded, $this->standardChars, $this->customChars); 
        return $this->reverseOutput ? strrev($customEncoded) : $customEncoded;  
    }
 
    public function decode($data) {
        if ($this->reverseOutput) {
            $data = strrev($data);  
        }
        $customEncoded = strtr($data, $this->customChars, $this->standardChars);  
        return base64_decode($customEncoded, true);  
    }

}