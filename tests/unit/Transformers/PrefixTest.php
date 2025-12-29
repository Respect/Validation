<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Transformers;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Respect\Validation\Test\TestCase;

#[Group('core')]
#[CoversClass(Prefix::class)]
final class PrefixTest extends TestCase
{
    #[Test]
    #[DataProvider('providerForTransformedRuleSpec')]
    public function itShouldTransformRuleSpec(RuleSpec $original, RuleSpec $expected): void
    {
        $transformer = new Prefix();
        $transformed = $transformer->transform($original);

        self::assertEquals($expected, $transformed);
    }

    #[Test]
    #[DataProvider('providerForUntransformedRuleNames')]
    public function itShouldPreventTransformingCanonicalRule(string $ruleName): void
    {
        $ruleSpec = new RuleSpec($ruleName);

        $transformer = new Prefix();
        self::assertSame($ruleSpec, $transformer->transform($ruleSpec));
    }

    /** @return array<array{RuleSpec, RuleSpec}> */
    public static function providerForTransformedRuleSpec(): array
    {
        return [
            'key' => [
                new RuleSpec('keyNextRule', ['keyName', 123]),
                new RuleSpec('NextRule', [123], new RuleSpec('key', ['keyName'])),
            ],
            'length' => [
                new RuleSpec('lengthNextRule', [5]),
                new RuleSpec('NextRule', [5], new RuleSpec('length')),
            ],
            'max' => [
                new RuleSpec('maxNextRule', [1, 10]),
                new RuleSpec('NextRule', [1, 10], new RuleSpec('max')),
            ],
            'min' => [
                new RuleSpec('minNextRule', [1, 10]),
                new RuleSpec('NextRule', [1, 10], new RuleSpec('min')),
            ],
            'not' => [
                new RuleSpec('notNextRule', [1, 10]),
                new RuleSpec('NextRule', [1, 10], new RuleSpec('not')),
            ],
            'nullOr' => [
                new RuleSpec('nullOrNextRule', [1, 10]),
                new RuleSpec('NextRule', [1, 10], new RuleSpec('nullOr')),
            ],
            'property' => [
                new RuleSpec('propertyNextRule', ['propertyName', 567]),
                new RuleSpec('NextRule', [567], new RuleSpec('property', ['propertyName'])),
            ],
            'undefOr' => [
                new RuleSpec('undefOrNextRule', [1, 10]),
                new RuleSpec('NextRule', [1, 10], new RuleSpec('undefOr')),
            ],
        ];
    }

    /** @return array<array{string}> */
    public static function providerForUntransformedRuleNames(): array
    {
        return [
            'equals' => ['equals'],
            'key' => ['key'],
            'keyExists' => ['keyExists'],
            'keyOptional' => ['keyOptional'],
            'keySet' => ['keySet'],
            'length' => ['length'],
            'max' => ['max'],
            'maxAge' => ['maxAge'],
            'min' => ['min'],
            'minAge' => ['minAge'],
            'not' => ['not'],
            'undef' => ['undef'],
            'property' => ['property'],
            'propertyExists' => ['propertyExists'],
            'propertyOptional' => ['propertyOptional'],
        ];
    }
}
