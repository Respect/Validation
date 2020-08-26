<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayObject;
use Respect\Validation\Exceptions\KeyNestedException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validatable;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractRelated
 * @covers \Respect\Validation\Rules\KeyNested
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ivan Zinovyev <vanyazin@gmail.com>
 */
final class KeyNestedTest extends TestCase
{
    /**
     * @test
     */
    public function arrayWithPresentKeysWillReturnTrueForFullPathValidator(): void
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

    /**
     * @test
     */
    public function arrayWithNumericKeysWillReturnTrueForFullPathValidator(): void
    {
        $array = [
            0 => 'Zero, the hero!',
        ];

        $validatable = $this->createMock(Validatable::class);
        $validatable
            ->expects(self::once())
            ->method('check')
            ->with($array[0]);

        $rule = new KeyNested(0, $validatable);
        $rule->check($array);
    }

    /**
     * @test
     */
    public function arrayWithPresentKeysWillReturnTrueForHalfPathValidator(): void
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

    /**
     * @test
     */
    public function objectWithPresentPropertiesWillReturnTrueForDirtyPathValidator(): void
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

    /**
     * @test
     */
    public function emptyInputMustReturnFalse(): void
    {
        $rule = new KeyNested('bar.foo.baz');

        self::assertFalse($rule->validate(''));
    }

    /**
     * @test
     */
    public function emptyInputMustNotAssert(): void
    {
        $rule = new KeyNested('bar.foo.baz');
        $this->expectException(KeyNestedException::class);
        $rule->assert('');
    }

    /**
     * @test
     */
    public function emptyInputMustNotCheck(): void
    {
        $rule = new KeyNested('bar.foo.baz');
        $this->expectException(KeyNestedException::class);
        $rule->check('');
    }

    /**
     * @test
     */
    public function arrayWithEmptyKeyShouldReturnTrue(): void
    {
        $rule = new KeyNested('emptyKey');
        $input = ['emptyKey' => ''];

        self::assertTrue($rule->validate($input));
    }

    /**
     * @test
     */
    public function arrayWithAbsentKeyShouldThrowNestedKeyException(): void
    {
        $validator = new KeyNested('bar.bar');
        $object = [
            'baraaaaaa' => [
                'bar' => 'foo',
            ],
        ];
        $this->expectException(KeyNestedException::class);
        $validator->assert($object);
    }

    /**
     * @test
     */
    public function notArrayShouldThrowKeyException(): void
    {
        $validator = new KeyNested('baz.bar');
        $object = 123;
        $this->expectException(KeyNestedException::class);
        $validator->assert($object);
    }

    /**
     * @doesNotPerformAssertions
     *
     * @test
     */
    public function extraValidatorShouldValidateKey(): void
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
        $validator->assert($object);
    }

    /**
     * @test
     */
    public function notMandatoryExtraValidatorShouldPassWithAbsentKey(): void
    {
        $subValidator = new Length(1, 3);
        $validator = new KeyNested('bar.rab', $subValidator, false);
        $object = new stdClass();
        self::assertTrue($validator->validate($object));
    }

    /**
     * @test
     */
    public function arrayAccessWithPresentKeysWillReturnTrue(): void
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
