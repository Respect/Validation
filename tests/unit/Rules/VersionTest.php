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
use function uniqid;

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
        $sut = new Version();

        return [
            '1.0.0' => [$sut, '1.0.0'],
            '1.0.0-alpha' => [$sut, '1.0.0-alpha'],
            '1.0.0-alpha.1' => [$sut, '1.0.0-alpha.1'],
            '1.0.0-0.3.7' => [$sut, '1.0.0-0.3.7'],
            '1.0.0-x.7.z.92' => [$sut, '1.0.0-x.7.z.92'],
            '1.3.7+build.2.b8f12d7' => [$sut, '1.3.7+build.2.b8f12d7'],
            '1.3.7-rc.1' => [$sut, '1.3.7-rc.1'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $sut = new Version();

        return [
            'empty' => [$sut, ''],
            '1.3.7--' => [$sut, '1.3.7--'],
            '1.3.7++' => [$sut, '1.3.7++'],
            'random string' => [$sut, uniqid()],
            '1.2.3.4' => [$sut, '1.2.3.4'],
            '1.2.3.4-beta' => [$sut, '1.2.3.4-beta'],
            'beta without version' => [$sut, 'beta'],
        ];
    }
}
