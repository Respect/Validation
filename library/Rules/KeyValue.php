<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Factory;
use Respect\Validation\Validatable;

use function array_keys;
use function in_array;

final class KeyValue extends AbstractRule
{
    public function __construct(
        private readonly int|string $comparedKey,
        private readonly string $ruleName,
        private readonly int|string $baseKey
    ) {
    }

    public function assert(mixed $input): void
    {
        $rule = $this->getRule($input);

        try {
            $rule->assert($input[$this->comparedKey]);
        } catch (ValidationException $exception) {
            throw $this->overwriteExceptionParams($exception);
        }
    }

    public function check(mixed $input): void
    {
        $rule = $this->getRule($input);

        try {
            $rule->check($input[$this->comparedKey]);
        } catch (ValidationException $exception) {
            throw $this->overwriteExceptionParams($exception);
        }
    }

    public function validate(mixed $input): bool
    {
        try {
            $rule = $this->getRule($input);
        } catch (ValidationException $e) {
            return false;
        }

        return $rule->validate($input[$this->comparedKey]);
    }

    /**
     * @param mixed[] $extraParameters
     */
    public function reportError(mixed $input, array $extraParameters = []): ValidationException
    {
        try {
            return $this->overwriteExceptionParams($this->getRule($input)->reportError($input));
        } catch (ValidationException $exception) {
            return $this->overwriteExceptionParams($exception);
        }
    }

    private function getRule(mixed $input): Validatable
    {
        if (!isset($input[$this->comparedKey])) {
            throw parent::reportError($this->comparedKey);
        }

        if (!isset($input[$this->baseKey])) {
            throw parent::reportError($this->baseKey);
        }

        try {
            $rule = Factory::getDefaultInstance()->rule($this->ruleName, [$input[$this->baseKey]]);
            $rule->setName((string) $this->comparedKey);
        } catch (ComponentException $exception) {
            throw parent::reportError($input, ['component' => true]);
        }

        return $rule;
    }

    private function overwriteExceptionParams(ValidationException $exception): ValidationException
    {
        $params = [];
        foreach (array_keys($exception->getParams()) as $key) {
            if (in_array($key, ['template', 'translator'])) {
                continue;
            }

            $params[$key] = $this->baseKey;
        }
        $params['name'] = $this->comparedKey;

        $exception->updateParams($params);

        return $exception;
    }
}
