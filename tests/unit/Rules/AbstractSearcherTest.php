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

use PHPUnit\Framework\TestCase;

class AbstractSearcherTest extends TestCase
{
    protected $searcherRuleMock;

    protected function setUp()
    {
        $this->searcherRuleMock = $this->getMockForAbstractClass(AbstractSearcher::class);
    }

    public function testValidateShouldReturnTrueWhenEqualValueIsFoundInHaystack()
    {
        $this->searcherRuleMock->haystack = [1, 2, 3, 4];

        self::assertTrue($this->searcherRuleMock->validate('1'));
        self::assertTrue($this->searcherRuleMock->validate(1));
    }

    public function testValidateShouldReturnFalseWhenEqualValueIsNotFoundInHaystack()
    {
        $this->searcherRuleMock->haystack = [1, 2, 3, 4];

        self::assertFalse($this->searcherRuleMock->validate(5));
    }

    public function testValidateShouldReturnTrueWhenIdenticalValueIsFoundInHaystack()
    {
        $this->searcherRuleMock->haystack = [1, 2, 3, 4];
        $this->searcherRuleMock->compareIdentical = true;

        self::assertTrue($this->searcherRuleMock->validate(1));
        self::assertTrue($this->searcherRuleMock->validate(4));
    }

    public function testValidateShouldReturnFalseWhenIdenticalValueIsNotFoundInHaystack()
    {
        $this->searcherRuleMock->haystack = [1, 2, 3, 4];
        $this->searcherRuleMock->compareIdentical = true;

        self::assertFalse($this->searcherRuleMock->validate('1'));
        self::assertFalse($this->searcherRuleMock->validate('4'));
        self::assertFalse($this->searcherRuleMock->validate(5));
    }

    public function testValidateShouldReturnTrueWhenInputIsEmptyOrNullAndIdenticalToHaystack()
    {
        $this->searcherRuleMock->compareIdentical = true;

        self::assertTrue($this->searcherRuleMock->validate(null));

        $this->searcherRuleMock->haystack = '';

        self::assertTrue($this->searcherRuleMock->validate(''));
    }

    public function testValidateShouldReturnFalseWhenInputIsEmptyOrNullAndNotIdenticalToHaystack()
    {
        $this->searcherRuleMock->compareIdentical = true;

        self::assertFalse($this->searcherRuleMock->validate(''));

        $this->searcherRuleMock->haystack = '';

        self::assertFalse($this->searcherRuleMock->validate(null));
    }

    public function testValidateShouldReturnTrueWhenInputIsEmptyOrNullAndEqualsHaystack()
    {
        self::assertTrue($this->searcherRuleMock->validate(''));
        self::assertTrue($this->searcherRuleMock->validate(null));
    }

    public function testValidateShouldReturnFalseWhenInputIsEmptyOrNullAndNotEqualsHaystack()
    {
        $this->searcherRuleMock->haystack = 'Respect';

        self::assertFalse($this->searcherRuleMock->validate(''));
        self::assertFalse($this->searcherRuleMock->validate(null));
    }

    public function testValidateWhenHaystackIsNotArrayAndInputIsPartOfHaystack()
    {
        $this->searcherRuleMock->haystack = 'Respect';

        self::assertTrue($this->searcherRuleMock->validate('Res'));
        self::assertTrue($this->searcherRuleMock->validate('RES'));

        $this->searcherRuleMock->compareIdentical = true;

        self::assertFalse($this->searcherRuleMock->validate('RES'));
        self::assertTrue($this->searcherRuleMock->validate('Res'));
    }
}
