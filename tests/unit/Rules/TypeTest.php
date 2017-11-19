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
use stdClass;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Type
 * @covers \Respect\Validation\Exceptions\TypeException
 */
class TypeTest extends TestCase
{
    public function testShouldDefineTypeOnConstructor(): void
    {
        $type = 'int';
        $rule = new Type($type);

        self::assertSame($type, $rule->type);
    }

    public function testShouldNotBeCaseSensitive(): void
    {
        $rule = new Type('InTeGeR');

        self::assertTrue($rule->validate(42));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\ComponentException
     * @expectedExceptionMessage "whatever" is not a valid type
     */
    public function testShouldThrowExceptionWhenTypeIsNotValid(): void
    {
        new Type('whatever');
    }

    /**
     * @dataProvider providerForValidType
     */
    public function testShouldValidateValidTypes($type, $input): void
    {
        $rule = new Type($type);

        self::assertTrue($rule->validate($input));
    }

    /**
     * @dataProvider providerForInvalidType
     */
    public function testShouldNotValidateInvalidTypes($type, $input): void
    {
        $rule = new Type($type);

        self::assertFalse($rule->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\TypeException
     * @expectedExceptionMessage "Something" must be "integer"
     */
    public function testShouldThrowTypeExceptionWhenCheckingAnInvalidInput(): void
    {
        $rule = new Type('integer');
        $rule->check('Something');
    }

    public function providerForValidType()
    {
        return [
            ['array', []],
            ['bool', true],
            ['boolean', false],
            ['callable', function (): void {
            }],
            ['double', 0.8],
            ['float', 1.0],
            ['int', 42],
            ['integer', 13],
            ['null', null],
            ['object', new stdClass()],
            ['resource', tmpfile()],
            ['string', 'Something'],
        ];
    }

    public function providerForInvalidType()
    {
        return [
            ['int', '1'],
            ['bool', '1'],
        ];
    }
}
