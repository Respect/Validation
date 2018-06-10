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
 * @covers \Respect\Validation\Rules\Cnh
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Gabriel Pedro <gpedro@users.noreply.github.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Kinn Coelho Julião <kinncj@gmail.com>
 * @author Pascal Borreli <pascal@borreli.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class CnhTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Cnh();

        return [
            [$rule, '02650306461'],
            [$rule, '04397322870'],
            [$rule, '04375701302'],
            [$rule, '02996843266'],
            [$rule, '04375700501'],
            [$rule, '02605113410'],
            [$rule, '03247061306'],
            [$rule, '01258750259'],
            [$rule, '00739751580'],
            [$rule, '03375637504'],
            [$rule, '02542551342'],
            [$rule, '01708111400'],
            [$rule, '00836510948'],
            [$rule, '04365445978'],
            [$rule, '04324384302'],
            [$rule, '04339482949'],
            [$rule, '01036520050'],
            [$rule, '01612581027'],
            [$rule, '00603454740'],
            [$rule, '04129251992'],
            [$rule, '03401740201'],
            [$rule, '03417248301'],
            [$rule, '00670431345'],
            [$rule, '03292694405'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Cnh();

        return [
            [$rule, []],
            [$rule, new \stdClass()],
            [$rule, '0265131640'],
            [$rule, '0439732280'],
            [$rule, '0437571130'],
            [$rule, '0299684320'],
            [$rule, '0437571150'],
            [$rule, '0261511340'],
            [$rule, '0324716130'],
            [$rule, '0125875120'],
            [$rule, '0173975150'],
            [$rule, '0337563750'],
            [$rule, '0254255130'],
            [$rule, '0171811140'],
            [$rule, '0183651190'],
            [$rule, '0436544590'],
            [$rule, '0432438430'],
            [$rule, '0433948290'],
            [$rule, '0113652110'],
            [$rule, '0161258110'],
            [$rule, '0161345470'],
            [$rule, '0412925190'],
            [$rule, '0341174120'],
            [$rule, '0341724830'],
            [$rule, '0167143130'],
            [$rule, '0329269440'],
            [$rule, ''],
            [$rule, 'F265F3F6461'],
            [$rule, 'F439732287F'],
            [$rule, 'F43757F13F2'],
            [$rule, 'F2996843266'],
            [$rule, 'F43757FF5F1'],
            [$rule, 'F26F511341F'],
            [$rule, 'F3247F613F6'],
            [$rule, 'F125875F259'],
            [$rule, 'FF73975158F'],
            [$rule, 'F33756375F4'],
            [$rule, 'F2542551342'],
            [$rule, 'F17F81114FF'],
            [$rule, 'FF83651F948'],
            [$rule, 'F4365445978'],
            [$rule, 'F43243843F2'],
            [$rule, 'F4339482949'],
            [$rule, 'F1F3652FF5F'],
            [$rule, 'F1612581F27'],
            [$rule, 'FF6F345474F'],
            [$rule, 'F4129251992'],
            [$rule, 'F34F174F2F1'],
            [$rule, 'F34172483F1'],
            [$rule, 'FF67F431345'],
            [$rule, 'F32926944F5'],
            [$rule, '00265003006461'],
            [$rule, '0043973228700'],
            [$rule, '00437570013002'],
            [$rule, '002996843266'],
            [$rule, '004375700005001'],
            [$rule, '00260051134100'],
            [$rule, '00324700613006'],
            [$rule, '0012587500259'],
            [$rule, '00007397515800'],
            [$rule, '0033756375004'],
            [$rule, '002542551342'],
            [$rule, '001700811140000'],
            [$rule, '00008365100948'],
            [$rule, '004365445978'],
            [$rule, '0043243843002'],
            [$rule, '004339482949'],
            [$rule, '0010036520000500'],
            [$rule, '0016125810027'],
            [$rule, '000060034547400'],
            [$rule, '004129251992'],
            [$rule, '003400174002001'],
            [$rule, '0034172483001'],
            [$rule, '00006700431345'],
            [$rule, '0032926944005'],
        ];
    }
}
