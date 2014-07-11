<?php

use ScubaClick\Meta\Helpers;

class HelpersTest extends PHPUnit_Framework_TestCase
{
    public function testArrayGetsEncoded()
    {
		$value   = ['key' => 'value', 'another' => 'thingy'];
		$encoded = Helpers::maybeEncode($value);

		$this->assertJsonStringEqualsJsonString(json_encode($value), $encoded);
    }

    public function testStringDoesNotGetEncoded()
    {
		$string  = 'some string';
		$encoded = Helpers::maybeEncode($string);

    	$this->assertSame($string, $encoded);
    }

    public function testJsonGetsDecodedToArray()
    {
    	$array   = ['key' => 'value', 'another' => 'thingy'];
		$decoded = Helpers::maybeDecode(json_encode($array), true);

		$this->assertSame($array, $decoded);
    }

    public function testJsonGetsDecodedToObject()
    {
    	$array   = ['key' => 'value', 'another' => 'thingy'];
		$decoded = Helpers::maybeDecode(json_encode($array));

		$this->assertSame((object) $array, $decoded);
    }

    public function testStringDoesNotGetDecoded()
    {
		$string  = 'some string';
		$encoded = Helpers::maybeDecode($string);

    	$this->assertSame($string, $encoded);
    }
}
