<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Message\Parameter\Processor;
use Throwable;

use function call_user_func;
use function preg_replace_callback;
use function sprintf;

final class TemplateRenderer
{
    /** @var callable */
    private $translator;

    public function __construct(
        callable $translator,
        private readonly Processor $processor
    ) {
        $this->translator = $translator;
    }

    /**
     * @param mixed[] $parameters
     */
    public function render(string $template, mixed $input, array $parameters): string
    {
        $parameters['name'] ??= $this->processor->process('input', $input);

        return (string) preg_replace_callback(
            '/{{(\w+)(\|([^}]+))?}}/',
            function (array $matches) use ($parameters) {
                if (!isset($parameters[$matches[1]])) {
                    return $matches[0];
                }

                return $this->processor->process($matches[1], $parameters[$matches[1]], $matches[3] ?? null);
            },
            $this->translate($template)
        );
    }

    private function translate(mixed $message): string
    {
        try {
            return call_user_func($this->translator, (string) $message);
        } catch (Throwable $throwable) {
            throw new ComponentException(sprintf('Failed to translate "%s"', $message), 0, $throwable);
        }
    }
}
