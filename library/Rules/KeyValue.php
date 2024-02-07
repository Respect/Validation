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
use Respect\Validation\Helpers\CanBindEvaluateRule;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validatable;
use Respect\Validation\Validator;

use function array_keys;
use function array_map;
use function in_array;
use function Respect\Stringifier\stringify;

#[Template(
    'The value of',
    'The value of',
    self::TEMPLATE_STANDARD,
)]
#[Template(
    '{{baseKey}} must be valid to validate {{comparedKey}}',
    '{{baseKey}} must not be valid to validate {{comparedKey}}',
    self::TEMPLATE_COMPONENT,
)]
final class KeyValue extends AbstractRule
{
    use CanBindEvaluateRule;

    public const TEMPLATE_COMPONENT = '__component__';

    public function __construct(
        private readonly int|string $comparedKey,
        private readonly string $ruleName,
        private readonly int|string $baseKey
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $result = $this->bindEvaluate(new AllOf(new Key($this->comparedKey), new Key($this->baseKey)), $this, $input);
        if (!$result->isValid) {
            return $result;
        }

        try {
            $rule = Validator::__callStatic($this->ruleName, [$input[$this->baseKey]]);
            $nextSibling = $rule->evaluate($input[$this->comparedKey]);
            $nextSiblingParameters = ['name' => $this->getName() ?? (string) $this->comparedKey];
            $nextSiblingParameters += array_map(fn ($value) => $this->baseKey, $nextSibling->parameters);

            return (new Result($nextSibling->isValid, $input, $this))
                ->withNextSibling($nextSibling->withParameters($nextSiblingParameters))
                ->withNameIfMissing((string) $this->comparedKey);
        } catch (ComponentException) {
            return Result::failed($input, $this, self::TEMPLATE_COMPONENT)
                ->withParameters(['baseKey' => $this->baseKey, 'comparedKey' => $this->comparedKey]);
        }
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

    protected function getStandardTemplate(mixed $input): string
    {
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
