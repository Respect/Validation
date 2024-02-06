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
use Respect\Validation\Message\Template;
use Respect\Validation\Validatable;

use function array_keys;
use function in_array;
use function Respect\Stringifier\stringify;

#[Template(
    'Key {{name}} must be present',
    'Key {{name}} must not be present',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{baseKey}} must be valid to validate {{comparedKey}}',
    '{{baseKey}} must not be valid to validate {{comparedKey}}',
    self::TEMPLATE_COMPONENT,
)]
final class KeyValue extends AbstractRule
{
    public const TEMPLATE_COMPONENT = 'component';

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

    public function getTemplate(mixed $input): string
    {
        if ($this->template !== null) {
            return $this->template;
        }

        if (!isset($input[$this->comparedKey]) || !isset($input[$this->baseKey])) {
            return self::TEMPLATE_STANDARD;
        }

        try {
            $this->createRule($input[$this->baseKey]);
        } catch (ComponentException) {
            return self::TEMPLATE_COMPONENT;
        }

        return self::TEMPLATE_STANDARD;
    }

    /**
     * @return array<string, mixed>
     */
    public function getParams(): array
    {
        return [
            'baseKey' => $this->baseKey,
            'comparedKey' => $this->comparedKey,
        ];
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
            throw parent::reportError($input, ['name' => stringify($this->comparedKey)]);
        }

        if (!isset($input[$this->baseKey])) {
            throw parent::reportError($input, ['name' => stringify($this->baseKey)]);
        }

        try {
            return $this->createRule($input[$this->baseKey]);
        } catch (ComponentException) {
            throw parent::reportError($input);
        }
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

    private function createRule(mixed $input): Validatable
    {
        $rule = Factory::getDefaultInstance()->rule($this->ruleName, [$input]);
        $rule->setName((string)$this->comparedKey);

        return $rule;
    }
}
