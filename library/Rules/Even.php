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

/**
 * Validates an even number.
 *
 * @author Jean Pimentel <jeanfap@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul karikari <paulkarikari1@gmail.com>
 */
final class Even extends AbstractRule
{
    /**
     * validates whether the given input is an even number.
     *
     * @param mixed $input
     *
     * @return bool
     */
    public function validate($input): bool
    {
        return 0 === (int) $input % 2;
    }
}
