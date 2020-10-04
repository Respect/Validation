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

/**
 * Validates weather the input is a hex RGB color or not.
 *
 * @author Davide Pastore <pasdavide@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class HexRgbColor extends AbstractEnvelope
{
    public function __construct()
    {
        parent::__construct(new Regex('/^#?([0-9A-F]{3}|[0-9A-F]{6})$/i'));
    }
}
