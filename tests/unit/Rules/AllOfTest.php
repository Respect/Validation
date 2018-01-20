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
 * @covers \Respect\Validation\Rules\AllOf
 * @covers \Respect\Validation\Exceptions\AllOfException
 */
class AllOfTest extends TestCase
{
    public function testRemoveRulesShouldRemoveAllRules(): void
    {
        $o = new AllOf(new IntVal(), new Positive());
        $o->removeRules();
        self::assertEquals(0, count($o->getRules()));
    }

    public function testAddRulesUsingArrayOfRules(): void
    {
        $o = new AllOf();
        $o->addRules(
            [
                [$x = new IntVal(), new Positive()],
            ]
        );
        self::assertTrue($o->hasRule($x));
        self::assertTrue($o->hasRule('Positive'));
    }

    public function testAddRulesUsingSpecificationArray(): void
    {
        $o = new AllOf();
        $o->addRules(['Between' => [1, 2]]);
        self::assertTrue($o->hasRule('Between'));
    }

    public function testValidationShouldWorkIfAllRulesReturnTrue(): void
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
        self::assertTrue($o->check('any'));
        self::assertTrue($o->assert('any'));
        self::assertTrue($o->__invoke(''));
        self::assertTrue($o->check(''));
        self::assertTrue($o->assert(''));
    }

    /**
     * @dataProvider providerStaticDummyRules
     * @expectedException \Respect\Validation\Exceptions\AllOfException
     */
    public function testValidationAssertShouldFailIfAnyRuleFailsAndReturnAllExceptionsFailed($v1, $v2, $v3): void
    {
        $o = new AllOf($v1, $v2, $v3);
        self::assertFalse($o->__invoke('any'));
        self::assertFalse($o->assert('any'));
    }

    /**
     * @dataProvider providerStaticDummyRules
     * @expectedException \Respect\Validation\Exceptions\CallbackException
     */
    public function testValidationCheckShouldFailIfAnyRuleFailsAndThrowTheFirstExceptionOnly($v1, $v2, $v3): void
    {
        $o = new AllOf($v1, $v2, $v3);
        self::assertFalse($o->__invoke('any'));
        self::assertFalse($o->check('any'));
    }

    /**
     * @dataProvider providerStaticDummyRules
     * @expectedException \Respect\Validation\Exceptions\ValidationException
     */
    public function testValidationCheckShouldFailOnEmptyInput($v1, $v2, $v3): void
    {
        $o = new AllOf($v1, $v2, $v3);
        self::assertTrue($o->check(''));
    }

    /**
     * @dataProvider providerStaticDummyRules
     */
    public function testValidationShouldFailIfAnyRuleFails($v1, $v2, $v3): void
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
