<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use function count;

/**
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
class GroupedValidationException extends NestedValidationException
{
    public const NONE = 'none';
    public const SOME = 'some';

    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::NONE => 'All of the required rules must pass for {{name}}',
            self::SOME => 'These rules must pass for {{name}}',
        ],
        self::MODE_NEGATIVE => [
            self::NONE => 'None of there rules must pass for {{name}}',
            self::SOME => 'These rules must not pass for {{name}}',
        ],
    ];

    /**
     * {@inheritDoc}
     */
    protected function chooseTemplate(): string
    {
        $numRules = $this->getParam('passed');
        $numFailed = count($this->getChildren());

        return $numRules === $numFailed ? self::NONE : self::SOME;
    }
}
