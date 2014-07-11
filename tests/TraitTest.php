<?php

class TraitTest extends PHPUnit_Framework_TestCase
{
    public function testIsInitiallyEmpty()
    {
        return $this->getObjectForTrait('ScubaClick\\Meta\\MetaTrait');
    }
}
