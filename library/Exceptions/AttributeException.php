<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * Exceptions to be thrown by the Attribute Rule.
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class AttributeException extends NestedValidationException implements NonOmissibleException
{
    public const NOT_PRESENT = 'not_present';
    public const INVALID = 'invalid';

    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::NOT_PRESENT => 'Attribute {{name}} must be present',
            self::INVALID => 'Attribute {{name}} must be valid',
        ],
        self::MODE_NEGATIVE => [
            self::NOT_PRESENT => 'Attribute {{name}} must not be present',
            self::INVALID => 'Attribute {{name}} must not validate',
        ],
    ];

    /**
     * {@inheritDoc}
     */
    protected function chooseTemplate(): string
    {
        return $this->getParam('hasReference') ? self::INVALID : self::NOT_PRESENT;
    }
}
