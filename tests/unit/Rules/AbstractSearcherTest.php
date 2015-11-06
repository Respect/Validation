<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

class AbstractSearcherTest extends \PHPUnit_Framework_TestCase
{
    protected $searcherRuleMock;

    protected function setUp()
    {
        $this->searcherRuleMock = $this->getMockForAbstractClass('Respect\\Validation\\Rules\\AbstractSearcher');
    }

    public function testValidateShouldReturnTrueWhenEqualValueIsFoundInHaystack()
    {
        $this->searcherRuleMock->haystack = [1, 2, 3, 4];

        $this->assertTrue($this->searcherRuleMock->validate('1'));
        $this->assertTrue($this->searcherRuleMock->validate(1));
    }

    public function testValidateShouldReturnFalseWhenEqualValueIsNotFoundInHaystack()
    {
        $this->searcherRuleMock->haystack = [1, 2, 3, 4];

        $this->assertFalse($this->searcherRuleMock->validate(5));
    }

    public function testValidateShouldReturnTrueWhenIdenticalValueIsFoundInHaystack()
    {
        $this->searcherRuleMock->haystack = [1, 2, 3, 4];
        $this->searcherRuleMock->compareIdentical = true;

        $this->assertTrue($this->searcherRuleMock->validate(1));
        $this->assertTrue($this->searcherRuleMock->validate(4));
    }

    public function testValidateShouldReturnFalseWhenIdenticalValueIsNotFoundInHaystack()
    {
        $this->searcherRuleMock->haystack = [1, 2, 3, 4];
        $this->searcherRuleMock->compareIdentical = true;

        $this->assertFalse($this->searcherRuleMock->validate('1'));
        $this->assertFalse($this->searcherRuleMock->validate('4'));
        $this->assertFalse($this->searcherRuleMock->validate(5));
    }

    public function testValidateShouldReturnTrueWhenInputIsEmptyOrNullAndIdenticalToHaystack()
    {
        $this->searcherRuleMock->compareIdentical = true;

        $this->assertTrue($this->searcherRuleMock->validate(null));

        $this->searcherRuleMock->haystack = '';

        $this->assertTrue($this->searcherRuleMock->validate(''));
    }

    public function testValidateShouldReturnFalseWhenInputIsEmptyOrNullAndNotIdenticalToHaystack()
    {
        $this->searcherRuleMock->compareIdentical = true;

        $this->assertFalse($this->searcherRuleMock->validate(''));

        $this->searcherRuleMock->haystack = '';

        $this->assertFalse($this->searcherRuleMock->validate(null));
    }

    public function testValidateShouldReturnTrueWhenInputIsEmptyOrNullAndEqualsHaystack()
    {
        $this->assertTrue($this->searcherRuleMock->validate(''));
        $this->assertTrue($this->searcherRuleMock->validate(null));
    }

    public function testValidateShouldReturnFalseWhenInputIsEmptyOrNullAndNotEqualsHaystack()
    {
        $this->searcherRuleMock->haystack = 'Respect';

        $this->assertFalse($this->searcherRuleMock->validate(''));
        $this->assertFalse($this->searcherRuleMock->validate(null));
    }

    public function testValidateWhenHaystackIsNotArrayAndInputIsPartOfHaystack()
    {
        $this->searcherRuleMock->haystack = 'Respect';

        $this->assertTrue($this->searcherRuleMock->validate('Res'));
        $this->assertTrue($this->searcherRuleMock->validate('RES'));

        $this->searcherRuleMock->compareIdentical = true;

        $this->assertFalse($this->searcherRuleMock->validate('RES'));
        $this->assertTrue($this->searcherRuleMock->validate('Res'));
    }
}
