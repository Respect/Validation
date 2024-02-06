<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Attributes\ExceptionClass;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Message\Template;
use Respect\Validation\Rules\AllOf;

use function count;

/**
 * @mixin StaticValidator
 */
#[ExceptionClass(NestedValidationException::class)]
#[Template(
    'All of the required rules must pass for {{name}}',
    'None of these rules must pass for {{name}}',
    self::TEMPLATE_NONE,
)]
#[Template(
    'These rules must pass for {{name}}',
    'These rules must not pass for {{name}}',
    self::TEMPLATE_SOME,
)]
final class Validator extends AllOf
{
    public const TEMPLATE_NONE = 'none';
    public const TEMPLATE_SOME = 'some';

    public static function create(): self
    {
        return new self();
    }

    public function check(mixed $input): void
    {
        try {
            parent::check($input);
        } catch (ValidationException $exception) {
            if (count($this->getRules()) == 1 && $this->template) {
                $exception->updateTemplate($this->template);
            }

            throw $exception;
        }
    }

    /**
     * @param mixed[] $arguments
     */
    public static function __callStatic(string $ruleName, array $arguments): self
    {
        return self::create()->__call($ruleName, $arguments);
    }

    /**
     * @param mixed[] $arguments
     */
    public function __call(string $ruleName, array $arguments): self
    {
        $this->addRule(Factory::getDefaultInstance()->rule($ruleName, $arguments));

        return $this;
    }
}
