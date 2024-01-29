<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validatable;

#[Group('rule')]
#[CoversClass(AllOf::class)]
final class AllOfTest extends TestCase
{
    #[Test]
    public function validationShouldWorkIfAllRulesReturnTrue(): void
    {
        $valid1 = new Callback(static function () {
            return true;
        });
        $valid2 = new Callback(static function () {
            return true;
        });
        $valid3 = new Callback(static function () {
            return true;
        });
        $o = new AllOf($valid1, $valid2, $valid3);
        self::assertTrue($o->__invoke('any'));
        $o->check('any');
        $o->assert('any');
        self::assertTrue($o->__invoke(''));
        $o->check('');
        $o->assert('');
    }

    #[Test]
    #[DataProvider('providerStaticDummyRules')]
    public function validationAssertShouldFailIfAnyRuleFailsAndReturnAllExceptionsFailed(
        Validatable $rule1,
        Validatable $rule2,
        Validatable $rule3
    ): void {
        $o = new AllOf($rule1, $rule2, $rule3);
        self::assertFalse($o->__invoke('any'));

        $this->expectException(NestedValidationException::class);
        $o->assert('any');
    }

    #[Test]
    #[DataProvider('providerStaticDummyRules')]
    public function validationCheckShouldFailIfAnyRuleFailsAndThrowTheFirstExceptionOnly(
        Validatable $rule1,
        Validatable $rule2,
        Validatable $rule3
    ): void {
        $o = new AllOf($rule1, $rule2, $rule3);
        self::assertFalse($o->__invoke('any'));

        $this->expectException(ValidationException::class);
        $o->check('any');
    }

    #[Test]
    #[DataProvider('providerStaticDummyRules')]
    public function validationCheckShouldFailOnEmptyInput(
        Validatable $rule1,
        Validatable $rule2,
        Validatable $rule3
    ): void {
        $o = new AllOf($rule1, $rule2, $rule3);

        $this->expectException(ValidationException::class);
        $o->check('');
    }

    #[Test]
    #[DataProvider('providerStaticDummyRules')]
    public function validationShouldFailIfAnyRuleFails(
        Validatable $rule1,
        Validatable $rule2,
        Validatable $rule3
    ): void {
        $o = new AllOf($rule1, $rule2, $rule3);
        self::assertFalse($o->__invoke('any'));
    }

    /**
     * @return Validatable[][]
     */
    public static function providerStaticDummyRules(): array
    {
        $theInvalidOne = new Callback(static function () {
            return false;
        });
        $valid1 = new Callback(static function () {
            return true;
        });
        $valid2 = new Callback(static function () {
            return true;
        });

        return [
            [$theInvalidOne, $valid1, $valid2],
            [$valid2, $valid1, $theInvalidOne],
            [$valid2, $theInvalidOne, $valid1],
            [$valid1, $valid2, $theInvalidOne],
            [$valid1, $theInvalidOne, $valid2],
        ];
    }
}
