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

use ArrayObject;
use PHPUnit\Framework\TestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\KeyNested
 * @covers \Respect\Validation\Exceptions\KeyNestedException
 */
class KeyNestedTest extends TestCase
{
    public function testArrayWithPresentKeysWillReturnTrueForFullPathValidator(): void
    {
        $array = [
            'bar' => [
                'foo' => [
                    'baz' => 'hello world!',
                ],
                'foooo' => [
                    'boooo' => 321,
                ],
            ],
        ];

        $rule = new KeyNested('bar.foo.baz');

        self::assertTrue($rule->validate($array));
    }

    public function testArrayWithNumericKeysWillReturnTrueForFullPathValidator(): void
    {
        $array = [
            0 => 'Zero, the hero!',
        ];

        $rule = new KeyNested(0, new Equals('Zero, the hero!'));

        self::assertTrue($rule->check($array));
    }

    public function testArrayWithPresentKeysWillReturnTrueForHalfPathValidator(): void
    {
        $array = [
            'bar' => [
                'foo' => [
                    'baz' => 'hello world!',
                ],
                'foooo' => [
                    'boooo' => 321,
                ],
            ],
        ];

        $rule = new KeyNested('bar.foo');

        self::assertTrue($rule->validate($array));
    }

    public function testObjectWithPresentPropertiesWillReturnTrueForDirtyPathValidator(): void
    {
        $object = (object) [
            'bar' => (object) [
                'foo' => (object) [
                    'baz' => 'hello world!',
                ],
                'foooo' => (object) [
                    'boooo' => 321,
                ],
            ],
        ];

        $rule = new KeyNested('bar.foooo.');

        self::assertTrue($rule->validate($object));
    }

    public function testEmptyInputMustReturnFalse(): void
    {
        $rule = new KeyNested('bar.foo.baz');

        self::assertFalse($rule->validate(''));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyNestedException
     */
    public function testEmptyInputMustNotAssert(): void
    {
        $rule = new KeyNested('bar.foo.baz');
        $rule->assert('');
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyNestedException
     */
    public function testEmptyInputMustNotCheck(): void
    {
        $rule = new KeyNested('bar.foo.baz');
        $rule->check('');
    }

    public function testArrayWithEmptyKeyShouldReturnTrue(): void
    {
        $rule = new KeyNested('emptyKey');
        $input = ['emptyKey' => ''];

        self::assertTrue($rule->validate($input));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyNestedException
     */
    public function testArrayWithAbsentKeyShouldThrowNestedKeyException(): void
    {
        $validator = new KeyNested('bar.bar');
        $object = [
            'baraaaaaa' => [
                'bar' => 'foo',
            ],
        ];
        self::assertTrue($validator->assert($object));
    }

    /**
     * @expectedException \Respect\Validation\Exceptions\KeyNestedException
     */
    public function testNotArrayShouldThrowKeyException(): void
    {
        $validator = new KeyNested('baz.bar');
        $object = 123;
        self::assertFalse($validator->assert($object));
    }

    public function testExtraValidatorShouldValidateKey(): void
    {
        $subValidator = new Length(3, 7);
        $validator = new KeyNested('bar.foo.baz', $subValidator);
        $object = [
            'bar' => [
                'foo' => [
                    'baz' => 'example',
                ],
            ],
        ];
        self::assertTrue($validator->assert($object));
    }

    public function testNotMandatoryExtraValidatorShouldPassWithAbsentKey(): void
    {
        $subValidator = new Length(1, 3);
        $validator = new KeyNested('bar.rab', $subValidator, false);
        $object = new \stdClass();
        self::assertTrue($validator->validate($object));
    }

    public function testArrayAccessWithPresentKeysWillReturnTrue(): void
    {
        $arrayAccess = new ArrayObject([
            'bar' => [
                'foo' => [
                    'baz' => 'hello world!',
                ],
                'foooo' => [
                    'boooo' => 321,
                ],
            ],
        ]);

        $rule = new KeyNested('bar.foo.baz');

        self::assertTrue($rule->validate($arrayAccess));
    }
}
