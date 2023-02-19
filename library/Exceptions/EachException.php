<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

use function count;
use function current;

/**
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
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
        $messages = [$this->getId() => $this->renderMessage($this, $templates)];
        $count = -1;
        foreach ($this->getChildren() as $exception) {
            $count++;
            $id = $exception->getId();
            if (!$exception instanceof NestedValidationException) {
                $messages[$id . '.' . $count] = $this->renderMessage(
                    $exception,
                    $this->findTemplates($templates, $this->getId())
                );
                continue;
            }

            $messages[$id . '.' . $count] = $exception->getMessages(
                $this->findTemplates($templates, $id, $this->getId())
            );
            if (count($messages[$id . '.' . $count]) > 1) {
                continue;
            }

            $messages[$id . '.' . $count] = current($messages[$exception->getId()]);
        }

        return $messages;
    }
}
