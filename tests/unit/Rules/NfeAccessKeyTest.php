<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Test\RuleTestCase;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\NfeAccessKey
 *
 * @author Andrey Knupp Vital <andreykvital@gmail.com>
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class NfeAccessKeyTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $nfe = new NfeAccessKey();

        return [
            [$nfe, '52060433009911002506550120000007800267301615'],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $nfe = new NfeAccessKey();

        return [
            [$nfe, '31841136830118868211870485416765268625116906'],
            [$nfe, '21470801245862435081451225624565260861852679'],
            [$nfe, '45644318091447671194616059650873352394885852'],
            [$nfe, '17214281716057582143671174314277906696193888'],
            [$nfe, '56017280182977836779696364362142515138726654'],
            [$nfe, '90157126614010548506235171976891004177042525'],
            [$nfe, '78457064241662300187501877048374851128754067'],
            [$nfe, '39950148079977322431982386613620895568235903'],
            [$nfe, '90820939577654114875253907311677136672761216'],
            [$nfe, '11145573386990252067204852181837301'],
            [$nfe, '6209433147444876'],
            [$nfe, '00745996227609395385255721262102'],
            [$nfe, '58215798856653'],
            [$nfe, '24149625439084262707824706699374326'],
            [$nfe, '163907274335'],
            [$nfe, '67229454773008929675906894698'],
            [$nfe, '5858836670181917762140106857095788313119136'],
            [$nfe, '6098412281885524361833754087461339281130'],
            [$nfe, '9025299113310221'],
        ];
    }
}
