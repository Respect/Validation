<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\KeyException;
use Respect\Validation\Test\TestCase;
use Throwable;

#[Group('rule')]
#[CoversClass(AbstractRelated::class)]
#[CoversClass(Key::class)]
final class KeyTest extends TestCase
{
    #[Test]
    public function arrayWithPresentKeyShouldReturnTrue(): void
    {
        $validator = new Key('bar');
        $someArray = [];
        $someArray['bar'] = 'foo';
        self::assertTrue($validator->validate($someArray));
    }

    #[Test]
    public function arrayWithNumericKeyShouldReturnTrue(): void
    {
        $validator = new Key(0);
        $someArray = [];
        $someArray[0] = 'foo';
        self::assertTrue($validator->validate($someArray));
    }

    #[Test]
    public function emptyInputMustReturnFalse(): void
    {
        $validator = new Key('someEmptyKey');
        $input = '';

        self::assertFalse($validator->validate($input));
    }

    #[Test]
    public function emptyInputMustNotAssert(): void
    {
        $validator = new Key('someEmptyKey');

        $this->expectException(KeyException::class);

        $validator->assert('');
    }

    #[Test]
    public function emptyInputMustNotCheck(): void
    {
        $validator = new Key('someEmptyKey');

        $this->expectException(KeyException::class);

        $validator->check('');
    }

    #[Test]
    public function arrayWithEmptyKeyShouldReturnTrue(): void
    {
        $validator = new Key('someEmptyKey');
        $input = [];
        $input['someEmptyKey'] = '';

        self::assertTrue($validator->validate($input));
    }

    #[Test]
    public function shouldHaveTheSameReturnValueForAllValidators(): void
    {
        $rule = new Key('key', new NotEmpty());
        $input = ['key' => ''];

        try {
            $rule->assert($input);
            self::fail('`assert()` must throws exception');
        } catch (Throwable $e) {
        }

        try {
            $rule->check($input);
            self::fail('`check()` must throws exception');
        } catch (Throwable $e) {
        }

        self::assertFalse($rule->validate($input));
    }

    #[Test]
    public function arrayWithAbsentKeyShouldThrowKeyException(): void
    {
        $validator = new Key('bar');
        $someArray = [];
        $someArray['baraaaaaa'] = 'foo';

        $this->expectException(KeyException::class);

        $validator->assert($someArray);
    }

    #[Test]
    public function notArrayShouldThrowKeyException(): void
    {
        $validator = new Key('bar');
        $someArray = 123;

        $this->expectException(KeyException::class);

        $validator->assert($someArray);
    }

    #[Test]
    public function invalidConstructorParametersShouldThrowComponentExceptionUponInstantiation(): void
    {
        $this->expectException(ComponentException::class);

        new Key(['invalid']);
    }

    #[Test]
    #[DoesNotPerformAssertions]
    public function extraValidatorShouldValidateKey(): void
    {
        $subValidator = new Length(1, 3);
        $validator = new Key('bar', $subValidator);
        $someArray = [];
        $someArray['bar'] = 'foo';
        $validator->assert($someArray);
    }

    #[Test]
    public function notMandatoryExtraValidatorShouldPassWithAbsentKey(): void
    {
        $subValidator = new Length(1, 3);
        $validator = new Key('bar', $subValidator, false);
        $someArray = [];
        self::assertTrue($validator->validate($someArray));
    }
}
