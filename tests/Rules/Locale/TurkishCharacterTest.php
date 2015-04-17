<?php
namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Rules\Locale;

class TurkishCharacterTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldAcceptTurkish()
    {
        $rule = new TurkishCharacter;
        $this->assertTrue($rule->validate('Mustafa Kemal ATATÜRK'));
    }

    public function testShouldNotAcceptNonTurkish()
    {
        $rule = new TurkishCharacter;
        $this->assertFalse($rule->validate('Validation'));
    }
}
