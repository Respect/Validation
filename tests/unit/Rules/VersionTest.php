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
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Version
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class VersionTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Version();

        return [
            '1.0.0' => [$rule, '1.0.0'],
            '1.0.0-alpha' => [$rule, '1.0.0-alpha'],
            '1.0.0-alpha.1' => [$rule, '1.0.0-alpha.1'],
            '1.0.0-0.3.7' => [$rule, '1.0.0-0.3.7'],
            '1.0.0-x.7.z.92' => [$rule, '1.0.0-x.7.z.92'],
            '1.3.7+build.2.b8f12d7' => [$rule, '1.3.7+build.2.b8f12d7'],
            '1.3.7-rc.1' => [$rule, '1.3.7-rc.1'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Version();

        return [
            '' => [$rule, ''],
            '1.3.7--' => [$rule, '1.3.7--'],
            '1.3.7++' => [$rule, '1.3.7++'],
            'foo' => [$rule, 'foo'],
            '1.2.3.4' => [$rule, '1.2.3.4'],
            '1.2.3.4-beta' => [$rule, '1.2.3.4-beta'],
            'beta' => [$rule, 'beta'],
        ];
    }
}
