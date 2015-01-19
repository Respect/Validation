<?php
namespace Respect\Validation\Rules;

class NoTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldUseDefaultPattern()
    {
        $rule = new No();

        $actualPattern = $rule->regex;
        $expectedPattern = '/^n(o(t|pe)?|ix|ay)?$/i';

        $this->assertEquals($expectedPattern, $actualPattern);
    }

    public function testShouldUseLocalPatternForNoExpressionWhenDefined()
    {
        if (!defined('NOEXPR')) {
            $this->markTestSkipped('Constant NOEXPR is not defined');

            return;
        }

        $rule = new No(true);

        $actualPattern = $rule->regex;
        $expectedPattern = '/'.nl_langinfo(NOEXPR).'/i';

        $this->assertEquals($expectedPattern, $actualPattern);
    }

    /**
     * @dataProvider validNoProvider
     */
    public function testShouldValidatePatternAccordingToTheDefinedLocale($input)
    {
        $rule = new No();

        $this->assertTrue($rule->validate($input));
    }

    public function validNoProvider()
    {
        return array(
            array('N'),
            array('Nay'),
            array('Nix'),
            array('No'),
            array('Nope'),
            array('Not'),
        );
    }

    /**
     * @dataProvider invalidNoProvider
     */
    public function testShouldNotValidatePatternAccordingToTheDefinedLocale($input)
    {
        $rule = new No();

        $this->assertFalse($rule->validate($input));
    }

    public function invalidNoProvider()
    {
        return array(
            array('Donnot'),
            array('Never'),
            array('Niet'),
            array('Noooooooo'),
            array('Não'),
        );
    }
}
