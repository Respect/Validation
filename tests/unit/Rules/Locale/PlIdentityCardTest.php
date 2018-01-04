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

namespace Respect\Validation\Rules\Locale;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group  rule
 * @covers \Respect\Validation\Rules\Locale\PlIdentityCard
 */
class PlIdentityCardTest extends RuleTestCase
{
    protected function setUp(): void
    {
        $this->markTestIncomplete(PlIdentityCard::class.' needs to be refactored');
    }

    public function providerForValidInput(): array
    {
        $rule = new PlIdentityCard();

        return [
            [$rule, 'APH505567'],
            [$rule, 'AYE205410'],
            [$rule, 'AYW036733'],
        ];
    }

    public function providerForInvalidInput(): array
    {
        $rule = new PlIdentityCard();

        return [
            [$rule, 'AAAAAAAAA'],
            [$rule, 'APH 505567'],
            [$rule, 'AYE205411'],
            [$rule, 'AYW036731'],
        ];
    }
}
