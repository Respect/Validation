<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

/**
 * Validates whether the input is a hex RGB color or not.
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
