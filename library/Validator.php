<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\Rules\AllOf;

use function count;

/**
 * @mixin StaticValidator
 *
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Validator extends AllOf
{
    /**
     * Create instance validator.
     */
    public static function create(Validatable ...$rules): self
    {
        return new self(...$rules);
    }

    /**
     * @param mixed $input
     */
    public function assert($input): void
    {
        parent::assert($input);
    }

    public function isValid(mixed $input): bool
    {
        return parent::validate($input);
    }

    public function setName(string $name): Validatable
    {
        return parent::setName($name);
    }

    public function getName(): ?string
    {
        return parent::getName();
    }

    public function setTemplate(string $template): Validatable
    {
        return parent::setTemplate($template);
    }

    /**
     * @param mixed $input
     */
    public function check($input): void
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
     * Creates a new Validator instance with a rule that was called on the static method.
     *
     * @param mixed[] $arguments
     *
     * @throws ComponentException
     */
    public static function __callStatic(string $ruleName, array $arguments): self
    {
        return self::create()->__call($ruleName, $arguments);
    }

    /**
     * Create a new rule by the name of the method and adds the rule to the chain.
     *
     * @param mixed[] $arguments
     *
     * @throws ComponentException
     */
    public function __call(string $ruleName, array $arguments): self
    {
        $this->addRule(Factory::getDefaultInstance()->rule($ruleName, $arguments));

        return $this;
    }
}
