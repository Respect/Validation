<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\TestCase;
use Respect\Validation\Validatable;

$GLOBALS['is_link'] = null;

// This override is only needed for the test, since 
// symbolic links cannot be mocked properly in PHP.
// See this issue for more info: https://github.com/mikey179/vfsStream/issues/89
function is_link($link)
{
    $return = \is_link($link);
    if (null !== $GLOBALS['is_link']) {
        $return = $GLOBALS['is_link'];
        $GLOBALS['is_link'] = null;
    }

    return $return;
}

/**
 * @group rule
 * @covers \Respect\Validation\Exceptions\SymbolicLinkException
 * @covers \Respect\Validation\Rules\SymbolicLink
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Gus Antoniassi <gus.antoniassi@gmail.com>
 */
class SymbolicLinkTest extends TestCase
{
    /**
     * Data providers for valid symbolic links, both as text and as SplFileInfo.
     *
     * It returns an array of arrays. Each array contains an instance of Validatable
     * as the first element and an input in which the validation SHOULD pass.
     *
     * @return array[]
     */
    public function providerForValidLink()
    {
        $rule = new SymbolicLink();
        $validObject = $this->createMock('SplFileInfo');
        $validObject->expects(self::once())
                ->method('isLink')
                ->will(self::returnValue(true));

        return [
            [$rule, '/path/of/a/valid/link.lnk'],
            [$rule, $validObject],
        ];
    }

    /**
     * Data providers for invalid symbolic links, both as text and as SplFileInfo.
     *
     * It returns an array of arrays. Each array contains an instance of Validatable
     * as the first element and an input in which the validation SHOULD NOT pass.
     *
     * @return array[]
     */
    public function providerForInvalidLink()
    {
        $rule = new SymbolicLink();
        $invalidObject = $this->createMock('SplFileInfo');
        $invalidObject->expects(self::once())
                ->method('isLink')
                ->will(self::returnValue(false));

        return [
            [$rule, '/path/of/an/invalid/link.lnk'],
            [$rule, $invalidObject],
        ];
    }

    /**
     * @test
     *
     * @dataProvider providerForValidLink
     *
     * @param Validatable $validator
     * @param mixed       $input
     */
    public function validSymbolicLinkShouldReturnTrue(Validatable $validator, $input): void
    {
        $GLOBALS['is_link'] = true;

        self::assertTrue($validator->validate($input));
    }

    /**
     * @test
     *
     * @dataProvider providerForInvalidLink
     *
     * @param Validatable $validator
     * @param mixed       $input
     */
    public function invalidSymbolicLinkShouldThrowException(Validatable $validator, $input): void
    {
        $GLOBALS['is_link'] = false;

        self::assertFalse($validator->validate($input));
    }
}
