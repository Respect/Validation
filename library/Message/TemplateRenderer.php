<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use Respect\Validation\Exceptions\ComponentException;
use Throwable;

use function call_user_func;
use function is_scalar;
use function preg_replace_callback;
use function Respect\Stringifier\stringify;
use function sprintf;

final class TemplateRenderer
{
    /** @var callable */
    private $translator;

    public function __construct(
        callable $translator,
        private readonly ParameterStringifier $parameterStringifier
    ) {
        $this->translator = $translator;
    }

    /**
     * @param mixed[] $parameters
     */
    public function render(string $template, mixed $input, array $parameters): string
    {
        $parameters['name'] ??= $this->parameterStringifier->stringify('input', $input);

        return (string) preg_replace_callback(
            '/{{(\w+)(\|(trans|raw))?}}/',
            function (array $matches) use ($parameters): string {
                if (!isset($parameters[$matches[1]])) {
                    return $matches[0];
                }

                $modifier = $matches[3] ?? null;
                if ($modifier === 'raw' && is_scalar($parameters[$matches[1]])) {
                    return (string) $parameters[$matches[1]];
                }

                if ($modifier === 'trans') {
                    return $this->translate($parameters[$matches[1]]);
                }

                return $this->parameterStringifier->stringify($matches[1], $parameters[$matches[1]]);
            },
            $this->translate($template)
        );
    }

    private function translate(mixed $message): string
    {
        if (!is_scalar($message)) {
            throw new ComponentException(sprintf('Cannot translate scalar value "%s"', stringify($message)));
        }

        try {
            return call_user_func($this->translator, (string) $message);
        } catch (Throwable $throwable) {
            throw new ComponentException(sprintf('Failed to translate "%s"', $message), 0, $throwable);
        }
    }
}
