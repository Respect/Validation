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

use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Validatable;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Attribute
 * @covers \Respect\Validation\Exceptions\AttributeException
 */
final class AttributeTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $obj = new \stdClass();
        $obj->bar = 'foo';

        $extraValidator = $this->createMock(Validatable::class);
        $extraValidator->method('validate')
            ->willReturn(true);

        return [
            'Is valid when attribute is present without extra validator' => [new Attribute('bar'), $obj],
            'Is valid when private attribute is present without extra validator' => [new Attribute('bar'), $this->objectWithPrivateProperty()],
            'Is valid when attribute is present with extra validator' => [new Attribute('bar', $extraValidator), $obj],
            'Is valid when non mandatory attribute is not present' => [new Attribute('foo', null, false), $obj],
            'Is valid when non mandatory attribute is not present with extra validator' => [new Attribute('foo', $extraValidator, false), $obj],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $obj = new \stdClass();
        $obj->bar = 'foo';

        $extraValidatorMock = $this->createMock(Validatable::class);
        $extraValidatorMock->method('validate')->willReturn(false);

        return [
            'Is not valid when attribute is absent without extra validator' => [new Attribute('barr'), $obj],
            'Is not valid when private attribute is not valid based on extra validator' => [new Attribute('bar', $extraValidatorMock), $this->objectWithPrivateProperty()],
            'Is not valid when value provided is an empty string' => [new Attribute('barr'), ''],
            'Is not valid when validator related to attribute does not validate' => [new Attribute('bar', $extraValidatorMock), $obj],
        ];
    }

    private function objectWithPrivateProperty()
    {
        return new class() {
            public const PROPERTY_VALUE = 'foo';
            private $bar = self::PROPERTY_VALUE;
        };
    }
}
