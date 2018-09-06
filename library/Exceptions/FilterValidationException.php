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

namespace Respect\Validation\Exceptions;

/**
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class FilterValidationException extends ValidationException
{
    public const EXTRA = 'extra';

    /**
     * {@inheritdoc}
     */
    protected function chooseTemplate(): string
    {
        return $this->getParam('additionalChars') ? static::EXTRA : static::STANDARD;
    }
}
