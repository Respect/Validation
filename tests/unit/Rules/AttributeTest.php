<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;
use Respect\Validation\Test\Stubs\WithProperties;
use Respect\Validation\Test\Stubs\WithUninitialized;

/**
 * @group rule
 * @covers \Respect\Validation\Rules\AbstractRelated
 * @covers \Respect\Validation\Rules\Attribute
 */
final class AttributeTest extends RuleTestCase
{
    public const PROPERTY_VALUE = 'foo';

    private string $bar = self::PROPERTY_VALUE;

    /**
     * @return array<string, array{Attribute, mixed}>
     */
    public static function providerForValidInput(): array
    {
        return [
            'attribute is present without extra validator' => [new Attribute('public'), new WithProperties()],
            'private attribute is present without extra validator' => [
                new Attribute('private'),
                new WithProperties(),
            ],
            'attribute is present with extra validator' => [
                new Attribute('public', new AlwaysValid()),
                new WithProperties(),
            ],
            'attribute is present but uninitialized' => [
                new Attribute('uninitialized'),
                new WithUninitialized(),
            ],
            'non mandatory attribute is not present' => [
                new Attribute('nonexistent', null, false),
                new WithProperties(),
            ],
            'non mandatory attribute is not present with extra validator' => [
                new Attribute('nonexistent', new AlwaysValid(), false),
                new WithProperties(),
            ],
            'attribute is present but uninitialized with extra validator' => [
                new Attribute('uninitialized', new AlwaysValid()),
                new WithUninitialized(),
            ],
        ];
    }

    /**
     * @return array<string, array{Attribute, mixed}>
     */
    public static function providerForInvalidInput(): array
    {
        return [
            'attribute is absent without extra validator' => [new Attribute('barr'), new WithProperties()],
            'private attribute is not valid based on extra validator' => [
                new Attribute('private', new AlwaysInvalid()),
                new WithProperties(),
            ],
            'value provided is an empty string' => [new Attribute('barr'), ''],
            'validator related to attribute does not validate' => [
                new Attribute('public', new AlwaysInvalid()),
                new WithProperties(),
            ],
        ];
    }
}
