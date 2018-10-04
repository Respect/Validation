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
 * @author Dick van der Heiden <d.vanderheiden@inthere.nl>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class UuidException extends ValidationException
{
    public const VERSION = 'version';

    /**
     * {@inheritdoc}
     */
    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a valid UUID',
            self::VERSION => '{{name}} must be a valid UUID version {{version}}',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a valid UUID',
            self::VERSION => '{{name}} must not be a valid UUID version {{version}}',
        ],
    ];

    /**
     * {@inheritdoc}
     */
    protected function chooseTemplate(): string
    {
        if ($this->getParam('version')) {
            return self::VERSION;
        }

        return self::STANDARD;
    }
}
