<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Exceptions;

final class EachException extends NestedValidationException
{
    /**
     * @todo This method shares too much with the parent implementation
     *
     * @param array<string, string> $templates
     *
     * @return array<string, string>
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
