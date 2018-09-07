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
use function mb_strtoupper;
use function mt_rand;
use function random_int;
use function uniqid;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\PhpLabel
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Emmerson <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class PhpLabelTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new PhpLabel();

        return [
            [$rule, '_'],
            [$rule, 'foo'],
            [$rule, 'f00'],
            [$rule, uniqid('_')],
            [$rule, uniqid('a')],
            [$rule, mb_strtoupper(uniqid('_'))],
            [$rule, mb_strtoupper(uniqid('a'))],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new PhpLabel();

        return [
            [$rule, '%'],
            [$rule, '*'],
            [$rule, '-'],
            [$rule, 'f-o-o-'],
            [$rule, "\n"],
            [$rule, "\r"],
            [$rule, "\t"],
            [$rule, ' '],
            [$rule, 'f o o'],
            [$rule, '0ne'],
            [$rule, '0_ne'],
            [$rule, uniqid((string) random_int(0, 9))],
            [$rule, null],
            [$rule, mt_rand()],
            [$rule, 0],
            [$rule, 1],
            [$rule, []],
            [$rule, new \stdClass()],
            [$rule, new \DateTime()],
        ];
    }
}
