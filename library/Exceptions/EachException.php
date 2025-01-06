<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

/**
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 * @deprecated Using rule exceptions directly is deprecated, and will be removed in the next major version. Please use {@see ValidationException} instead.
 */
final class EachException extends NestedValidationException
{
    /**
     * {@inheritDoc}
     */
    protected $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Each item in {{name}} must be valid',
        ],
        self::MODE_NEGATIVE => [
            self::STANDARD => 'Each item in {{name}} must not validate',
        ],
    ];

    /**
     * {@inheritDoc}
     *
     * @todo This method shares too much with the parent implementation
     */
    public function getMessages(array $templates = []): array
    {
        $messages = [];
        $count = -1;
        foreach ($this->getChildren() as $exception) {
            $count++;
            $id = $exception->getId();

            $messages[$id . '.' . $count] = $this->renderMessage(
                $exception,
                $this->findTemplates($templates, $this->getId())
            );
        }

        return $messages;
    }
}
