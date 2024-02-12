<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Helpers;

use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Message\Parameter\Stringify;
use Respect\Validation\Message\TemplateRenderer;

use function sprintf;
use function trigger_error;

use const E_USER_DEPRECATED;

trait DeprecatedValidatableMethods
{
    public function validate(mixed $input): bool
    {
        $this->triggerDeprecation(__METHOD__);

        return false;
    }

    public function assert(mixed $input): void
    {
        $this->triggerDeprecation(__FUNCTION__);
    }

    public function check(mixed $input): void
    {
        $this->triggerDeprecation(__FUNCTION__);
    }

    /** @param array<string, mixed> $extraParameters */
    public function reportError(mixed $input, array $extraParameters = []): ValidationException
    {
        $this->triggerDeprecation(__FUNCTION__);

        return new ValidationException(
            input: $input,
            id:  'id',
            params: $extraParameters,
            template: 'template',
            templates: [],
            formatter: new TemplateRenderer(static fn (string $message) => $message, new Stringify()),
        );
    }

    /** @return array<string, mixed> */
    public function getParams(): array
    {
        $this->triggerDeprecation(__FUNCTION__);

        return [];
    }

    private function triggerDeprecation(string $function): void
    {
        trigger_error(
            sprintf('The "%s" method is deprecated, please use the "Validator" class instead.', $function),
            E_USER_DEPRECATED
        );
    }
}
