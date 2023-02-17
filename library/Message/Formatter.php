<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Message;

use function call_user_func;
use function preg_replace_callback;
use function Respect\Stringifier\stringify;

final class Formatter
{
    /**
     * @var callable
     */
    private $translator;

    /**
     * @var ParameterStringifier
     */
    private $parameterStringifier;

    public function __construct(callable $translator, ParameterStringifier $parameterStringifier)
    {
        $this->translator = $translator;
        $this->parameterStringifier = $parameterStringifier;
    }

    /**
     * @param mixed $input
     * @param mixed[] $parameters
     */
    public function format(string $template, $input, array $parameters): string
    {
        $parameters['name'] = $parameters['name'] ?? stringify($input);

        return preg_replace_callback(
            '/{{(\w+)}}/',
            function ($match) use ($parameters) {
                if (!isset($parameters[$match[1]])) {
                    return $match[0];
                }

                return $this->parameterStringifier->stringify($match[1], $parameters[$match[1]]);
            },
            call_user_func($this->translator, $template)
        );
    }
}
