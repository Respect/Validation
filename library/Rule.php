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

namespace Respect\Validation;

/**
 * Interface for rules.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 2.0.0
 */
interface Rule
{
    /**
     * Validates the rule against the given input.
     *
     * @param mixed $input
     *
     * @return Result
     */
    public function apply($input): Result;
}
