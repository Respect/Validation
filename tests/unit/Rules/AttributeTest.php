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

use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Validatable;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\AbstractRelated
 * @covers \Respect\Validation\Rules\Attribute
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AttributeTest extends RuleTestCase
{
    public const PROPERTY_VALUE = 'foo';

    /**
     * @var string
     */
    private $bar = self::PROPERTY_VALUE;

    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $obj = new stdClass();
        $obj->bar = 'foo';

        $extraValidator = $this->createMock(Validatable::class);
        $extraValidator->method('validate')
            ->willReturn(true);

        return [
            'attribute is present without extra validator' => [new Attribute('bar'), $obj],
            'private attribute is present without extra validator' => [
                new Attribute('bar'),
                $this,
            ],
            'attribute is present with extra validator' => [new Attribute('bar', $extraValidator), $obj],
            'non mandatory attribute is not present' => [new Attribute('foo', null, false), $obj],
            'non mandatory attribute is not present with extra validator' => [
                new Attribute('foo', $extraValidator, false),
                $obj,
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $obj = new stdClass();
        $obj->bar = 'foo';

        $extraValidatorMock = $this->createMock(Validatable::class);
        $extraValidatorMock->method('validate')->willReturn(false);

        return [
            'attribute is absent without extra validator' => [new Attribute('barr'), $obj],
            'private attribute is not valid based on extra validator' => [
                new Attribute('bar', $extraValidatorMock),
                $this,
            ],
            'value provided is an empty string' => [new Attribute('barr'), ''],
            'validator related to attribute does not validate' => [new Attribute('bar', $extraValidatorMock), $obj],
        ];
    }
}
