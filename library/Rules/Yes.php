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

use function defined;
use function nl_langinfo;

/**
 * Validates if value is considered as "Yes".
 *
 * @author Cameron Hall <me@chall.id.au>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Yes extends Regex
{
    /**
     * Initializes the rule.
     *
     * @param bool $useLocale
     */
    public function __construct(bool $useLocale = false)
    {
        $pattern = '^y(eah?|ep|es)?$';
        if ($useLocale && defined('YESEXPR')) {
            $pattern = nl_langinfo(YESEXPR);
        }

        parent::__construct('/'.$pattern.'/i');
    }
}
