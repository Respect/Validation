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

use const YESEXPR;
use function is_string;
use function nl_langinfo;
use function preg_match;

/**
 * Validates if the input considered as "Yes".
 *
 * @author Cameron Hall <me@chall.id.au>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Yes extends AbstractRule
{
    /**
     * @var bool
     */
    private $useLocale;

    /**
     * Initializes the rule.
     *
     * @param bool $useLocale
     */
    public function __construct(bool $useLocale = false)
    {
        $this->useLocale = $useLocale;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        if (!is_string($input)) {
            return false;
        }

        return preg_match($this->getPattern(), $input) > 0;
    }

    private function getPattern(): string
    {
        if ($this->useLocale) {
            return '/'.nl_langinfo(YESEXPR).'/';
        }

        return '/^y(eah?|ep|es)?$/i';
    }
}
