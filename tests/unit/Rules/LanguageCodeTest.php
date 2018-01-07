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

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\LanguageCode
 */
class LanguageCodeTest extends RuleTestCase
{
    public function providerForValidInput(): array
    {
        $ruleAlpha2 = new LanguageCode();
        $ruleAlpha3 = new LanguageCode('alpha-3');

        return [
            [$ruleAlpha2, 'pt'],
            [$ruleAlpha3, 'por'],
            [$ruleAlpha2, 'en'],
            [$ruleAlpha3, 'eng'],
            [$ruleAlpha2, 'it'],
            [$ruleAlpha3, 'ita'],
            [$ruleAlpha2, 'la'],
            [$ruleAlpha3, 'lat'],
        ];
    }

    public function providerForInvalidInput(): array
    {
        $ruleAlpha2 = new LanguageCode();
        $ruleAlpha3 = new LanguageCode('alpha-3');

        return [
            [$ruleAlpha2, 'por'],
            [$ruleAlpha2, ''],
            [$ruleAlpha2, null],
            [$ruleAlpha2, false],
            [$ruleAlpha2, []],
            [$ruleAlpha3, 'pt'],
        ];
    }
}
