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

use DateTime;
use Respect\Validation\Test\RuleTestCase;
use stdClass;
use function mt_getrandmax;
use function mt_rand;
use function uniqid;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Factor
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author David Meister <thedavidmeister@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class FactorTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        return [
            '1 is factor 1' => [new Factor(1), 1],
            '1 is factor 2' => [new Factor(2), 1],
            '3 is factor 3' => [new Factor(3), 3],
            '4 is factor 2' => [new Factor(4), 2],
            '4 is factor 4' => [new Factor(4), 4],
            '5 is factor 1' => [new Factor(5), 1],
            '5 is factor 5' => [new Factor(5), 5],
            '6 is factor 1' => [new Factor(6), 1],
            '6 is factor 2' => [new Factor(6), 2],
            '0 is factor 0' => [new Factor(0), 0],
            '0 is factor 1' => [new Factor(0), 1],
            '0 is factor mt_rand()' => [new Factor(0), mt_rand()],
            '-0 is factor 1' => [new Factor(-0), 1],
            '-6 is factor 2' => [new Factor(-6), 2],
            '-3 is factor 3' => [new Factor(-3), 3],
            '-5 is factor 1' => [new Factor(-5), 1],
            '-0 is factor mt_rand' => [new Factor(-0), mt_rand()],
            '-5 is factor -1' => [new Factor(-5), -1],
            '-6 is factor -1' => [new Factor(-6), -1],
            '-3 is factor -3' => [new Factor(-3), -3],
            '-0 is factor -mt_rand()' => [new Factor(-0), -mt_rand()],
            '6 is factor \'1\'' => [new Factor(6), '1'],
            '6 is factor \'2\'' => [new Factor(6), '2'],
            '4 is factor 2.00' => [new Factor(4), 2.0],
            '-0 is factor -5.000000' => [new Factor(-0), -5.000000],
            '-0 is factor (float) -mt_rand()' => [new Factor(-0), (float) -mt_rand()],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        return [
            '3 is not factor 2' => [new Factor(3), 2],
            '4 is not factor 3' => [new Factor(4), 3],
            '5 is not factor 2' => [new Factor(5), 2],
            '5 is not factor 3' => [new Factor(5), 3],
            '5 is not factor 4' => [new Factor(5), 4],
            '1 is not factor 0' => [new Factor(1), 0],
            '2 is not factor 0' => [new Factor(2), 0],
            '-2 is not factor 0' => [new Factor(-2), 0],
            '-5 is not factor 4' => [new Factor(-5), 4],
            '-4 is not factor 3' => [new Factor(-4), 3],
            '-3 is not factor -2' => [new Factor(-3), -2],
            '-5 is not factor -2' => [new Factor(-5), -2],
            '-2 is not factor -0' => [new Factor(-2), -0],
            '-2 is not factor \'-0.0000\'' => [new Factor(-2), '-0.0000'],
            '-2 is not factor 0.00' => [new Factor(-2), 0.00],
            '3 is not factor 2.0' => [new Factor(3), 2.0],
            '5 is not factor 2.000000' => [new Factor(5), 2.000000],
            'mt_rand is not factor 0.5' => [new Factor(mt_rand()), 0.5],
            'mt_rand is not factor 1.5' => [new Factor(mt_rand()), 1.5],
            'mt_rand is not factor -0.5' => [new Factor(mt_rand()), -0.5],
            'mt_rand is not factor -1.5' => [new Factor(mt_rand()), -1.5],
            'mt_rand is not factor PHP_INT_MAX + 1' => [new Factor(mt_rand()), PHP_INT_MAX + 1],
            'mt_rand is not factor calc' => [new Factor(mt_rand()), mt_rand(1, mt_getrandmax() - 1) / mt_getrandmax()],
            'mt_rand is not factor -calc' => [new Factor(mt_rand()), -(mt_rand(1, mt_getrandmax() - 1) / mt_getrandmax())],
            'mt_rand is not factor \'a\'' => [new Factor(mt_rand()), 'a'],
            'mt_rand is not factor \'foo\'' => [new Factor(mt_rand()), 'foo'],
            'mt_rand is not factor uniqid(\'a\')' => [new Factor(mt_rand()), uniqid('a')],
            'mt_rand is not factor []' => [new Factor(mt_rand()), []],
            'mt_rand is not factor stdClass' => [new Factor(mt_rand()), new stdClass()],
            'mt_rand is not factor Datetime' => [new Factor(mt_rand()), new DateTime()],
            'mt_rand is not factor null' => [new Factor(mt_rand()), null],
            'mt_rand is not factor true' => [new Factor(mt_rand()), true],
            'mt_rand is not factor false' => [new Factor(mt_rand()), false],
        ];
    }
}
