<?php
namespace Respect\Validation\Rules;

/**
 * @covers Respect\Validation\Rules\FilterVar
 */
class FilterVarTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot validate without filter flag
     */
    public function testShouldThrowsExceptionWhenFilterIsNotDefined()
    {
        new FilterVar();
    }

    /**
     * @expectedException Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage Cannot accept the given filter
     */
    public function testShouldThrowsExceptionWhenFilterIsNotValid()
    {
        new FilterVar(FILTER_SANITIZE_EMAIL);
    }

    public function testShouldDefineFilterOnConstructor()
    {
        $rule = new FilterVar(FILTER_VALIDATE_REGEXP);

        $actualArguments = $rule->arguments;
        $expectedArguments = array(FILTER_VALIDATE_REGEXP);

        $this->assertEquals($expectedArguments, $actualArguments);
    }

    public function testShouldDefineFilterOptionsOnConstructor()
    {
        $rule = new FilterVar(FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);

        $actualArguments = $rule->arguments;
        $expectedArguments = array(FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED);

        $this->assertEquals($expectedArguments, $actualArguments);
    }

    public function testShouldUseDefineFilterToValidate()
    {
        $rule = new FilterVar(FILTER_VALIDATE_EMAIL);

        $this->assertTrue($rule->validate('henriquemoody@users.noreply.github.com'));
    }

    public function testShouldUseDefineFilterOptionsToValidate()
    {
        $rule = new FilterVar(FILTER_VALIDATE_URL, FILTER_FLAG_QUERY_REQUIRED);

        $this->assertTrue($rule->validate('http://example.com?foo=bar'));
    }
}
