<?php

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Gonçalo Andrade <goncalo.andrade95@gmail.com>
 */
final class PortugueseNifException extends ValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => '{{name}} must be a Portuguese NIF',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => '{{name}} must not be a Portuguese NIF',
        ],
    ];
}
