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

use function is_scalar;
use function preg_match;
use function sprintf;

/**
 * Validates whether the input is a valid phone number.
 *
 * Validates a valid 7, 10, 11 digit phone number (North America, Europe and
 * most Asian and Middle East countries), supporting country and area codes (in
 * dot,space or dashed notations)
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Graham Campbell <graham@mineuk.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Phone extends AbstractRule
{
    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        if (!is_scalar($input)) {
            return false;
        }

        return preg_match($this->getPregFormat(), (string) $input) > 0;
    }

    private function getPregFormat(): string
    {
        return sprintf(
            '/^\+?(%1$s)? ?(?(?=\()(\(%2$s\) ?%3$s)|([. -]?(%2$s[. -]*)?%3$s))$/',
            '\d{0,3}',
            '\d{1,3}',
            '((\d{3,5})[. -]?(\d{4})|(\d{2}[. -]?){4})'
        );
    }
}
