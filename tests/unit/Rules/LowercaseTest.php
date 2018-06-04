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
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Lowercase
 *
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Jean Pimentel <jeanfap@gmail.com>
 */
final class LowercaseTest extends RuleTestCase
{
    /*
    * {@inheritdoc}
    */
    public function providerForValidInput(): array
    {
        $rule = new Lowercase();

        return [
            [$rule, ''],
            [$rule, 'lowercase'],
            [$rule, 'lowercase-with-dashes'],
            [$rule, 'lowercase with spaces'],
            [$rule, 'lowercase with numbers 123'],
            [$rule, 'lowercase with specials characters like ã ç ê'],
            [$rule, 'with specials characters like # $ % & * +'],
            [$rule, 'τάχιστη αλώπηξ βαφής ψημένη γη, δρασκελίζει υπέρ νωθρού κυνός'],
            [$rule, '42'],
            [$rule, '!@#$%^'],
        ];
    }

    /*
    * {@inheritdoc}
    */
    public function providerForInvalidInput(): array
    {
        $rule = new Lowercase();

        return [
            [$rule, 42],
            [$rule, []],
            [$rule, new stdClass()],
            [$rule, 'UPPERCASE'],
            [$rule, 'CamelCase'],
            [$rule, 'First Character Uppercase'],
            [$rule, 'With Numbers 1 2 3'],
        ];
    }
}
