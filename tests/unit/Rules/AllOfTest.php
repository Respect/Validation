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

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\CallbackException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Test\TestCase;
use Respect\Validation\Validatable;

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\AllOfException
 * @covers \Respect\Validation\Rules\AllOf
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Nick Lombard <github@jigsoft.co.za>
 */
final class AllOfTest extends TestCase
{
    /**
     * @test
     */
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

    /**
     * @dataProvider providerStaticDummyRules
     *
     * @test
     */
    public function validationAssertShouldFailIfAnyRuleFailsAndReturnAllExceptionsFailed(
        Validatable $rule1,
        Validatable $rule2,
        Validatable $rule3
    ): void {
        $o = new AllOf($rule1, $rule2, $rule3);
        self::assertFalse($o->__invoke('any'));

        $this->expectException(AllOfException::class);
        $o->assert('any');
    }

    /**
     * @dataProvider providerStaticDummyRules
     *
     * @test
     */
    public function validationCheckShouldFailIfAnyRuleFailsAndThrowTheFirstExceptionOnly(
        Validatable $rule1,
        Validatable $rule2,
        Validatable $rule3
    ): void {
        $o = new AllOf($rule1, $rule2, $rule3);
        self::assertFalse($o->__invoke('any'));

        $this->expectException(CallbackException::class);
        $o->check('any');
    }

    /**
     * @dataProvider providerStaticDummyRules
     * @expectedException \Respect\Validation\Exceptions\
     *
     * @test
     */
    public function validationCheckShouldFailOnEmptyInput(
        Validatable $rule1,
        Validatable $rule2,
        Validatable $rule3
    ): void {
        $o = new AllOf($rule1, $rule2, $rule3);

        $this->expectException(ValidationException::class);
        $o->check('');
    }

    /**
     * @dataProvider providerStaticDummyRules
     *
     * @test
     */
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
    public function providerStaticDummyRules(): array
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
