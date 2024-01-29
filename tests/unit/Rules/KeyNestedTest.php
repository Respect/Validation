<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayObject;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validatable;
use stdClass;

#[Group('rule')]
#[CoversClass(AbstractRelated::class)]
#[CoversClass(KeyNested::class)]
final class KeyNestedTest extends TestCase
{
    #[Test]
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

    #[Test]
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

    #[Test]
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

    #[Test]
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

    #[Test]
    public function emptyInputMustReturnFalse(): void
    {
        $rule = new KeyNested('bar.foo.baz');

        self::assertFalse($rule->validate(''));
    }

    #[Test]
    public function emptyInputMustNotAssert(): void
    {
        $rule = new KeyNested('bar.foo.baz');
        $this->expectException(ValidationException::class);
        $rule->assert('');
    }

    #[Test]
    public function emptyInputMustNotCheck(): void
    {
        $rule = new KeyNested('bar.foo.baz');
        $this->expectException(ValidationException::class);
        $rule->check('');
    }

    #[Test]
    public function arrayWithEmptyKeyShouldReturnTrue(): void
    {
        $rule = new KeyNested('emptyKey');
        $input = ['emptyKey' => ''];

        self::assertTrue($rule->validate($input));
    }

    #[Test]
    public function arrayWithAbsentKeyShouldThrowNestedKeyException(): void
    {
        $validator = new KeyNested('bar.bar');
        $object = [
            'baraaaaaa' => [
                'bar' => 'foo',
            ],
        ];
        $this->expectException(ValidationException::class);
        $validator->assert($object);
    }

    #[Test]
    public function notArrayShouldThrowKeyException(): void
    {
        $validator = new KeyNested('baz.bar');
        $object = 123;
        $this->expectException(ValidationException::class);
        $validator->assert($object);
    }

    #[Test]
    #[DoesNotPerformAssertions]
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

    #[Test]
    public function notMandatoryExtraValidatorShouldPassWithAbsentKey(): void
    {
        $subValidator = new Length(1, 3);
        $validator = new KeyNested('bar.rab', $subValidator, false);
        $object = new stdClass();
        self::assertTrue($validator->validate($object));
    }

    #[Test]
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
