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
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author David Meister <thedavidmeister@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class FactorException extends ValidationException
{
    /**
     * {@inheritdoc}
     */
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a factor of {{dividend}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a factor of {{dividend}}',
        ],
    ];
}
