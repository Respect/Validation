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

/**
 * @group  rule
 * @covers \Respect\Validation\Exceptions\AllOfException
 * @covers \Respect\Validation\Rules\AllOf
 */
class AllOfTest extends TestCase
{
    /**
     * @test
     */
    public function validationShouldWorkIfAllRulesReturnTrue(): void
    {
        $valid1 = new Callback(function () {
            return true;
        });
        $valid2 = new Callback(function () {
            return true;
        });
        $valid3 = new Callback(function () {
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
     * @expectedException \Respect\Validation\Exceptions\AllOfException
     *
     * @test
     */
    public function validationAssertShouldFailIfAnyRuleFailsAndReturnAllExceptionsFailed($v1, $v2, $v3): void
    {
        $o = new AllOf($v1, $v2, $v3);
        self::assertFalse($o->__invoke('any'));
        $o->assert('any');
    }

    /**
     * @dataProvider providerStaticDummyRules
     * @expectedException \Respect\Validation\Exceptions\CallbackException
     *
     * @test
     */
    public function validationCheckShouldFailIfAnyRuleFailsAndThrowTheFirstExceptionOnly($v1, $v2, $v3): void
    {
        $o = new AllOf($v1, $v2, $v3);
        self::assertFalse($o->__invoke('any'));
        $o->check('any');
    }

    /**
     * @dataProvider providerStaticDummyRules
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     *
     * @test
     */
    public function validationCheckShouldFailOnEmptyInput($v1, $v2, $v3): void
    {
        $o = new AllOf($v1, $v2, $v3);
        $o->check('');
    }

    /**
     * @dataProvider providerStaticDummyRules
     *
     * @test
     */
    public function validationShouldFailIfAnyRuleFails($v1, $v2, $v3): void
    {
        $o = new AllOf($v1, $v2, $v3);
        self::assertFalse($o->__invoke('any'));
    }

    public function providerStaticDummyRules()
    {
        $theInvalidOne = new Callback(function () {
            return false;
        });
        $valid1 = new Callback(function () {
            return true;
        });
        $valid2 = new Callback(function () {
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
