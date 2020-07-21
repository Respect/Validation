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

use function nl_langinfo;

use const NOEXPR;

/**
 * Validates if value is considered as "No".
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class No extends AbstractEnvelope
{
    public function __construct(bool $useLocale = false)
    {
        $pattern = '^n(o(t|pe)?|ix|ay)?$';
        if ($useLocale) {
            $pattern = nl_langinfo(NOEXPR);
        }

        parent::__construct(new Regex('/' . $pattern . '/i'));
    }
}
