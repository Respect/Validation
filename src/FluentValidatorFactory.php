<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Fluent\Exceptions\CouldNotCreate;
use Respect\Fluent\Exceptions\CouldNotResolve;
use Respect\Fluent\FluentFactory;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\InvalidClassException;

use function sprintf;
use function trim;

final readonly class FluentValidatorFactory implements ValidatorFactory
{
    public function __construct(
        private FluentFactory $factory,
    ) {
    }

    /** @param array<int, mixed> $arguments */
    public function create(string $ruleName, array $arguments = []): Validator
    {
        try {
            $instance = $this->factory->create($ruleName, $arguments);
        } catch (CouldNotResolve $e) {
            throw new ComponentException(sprintf('"%s" is not a valid rule name', $ruleName), 0, $e);
        } catch (CouldNotCreate $e) {
            throw new InvalidClassException($e->getMessage(), 0, $e);
        }

        if (!$instance instanceof Validator) {
            throw new InvalidClassException(
                sprintf('"%s" must be an instance of "%s"', $ruleName, Validator::class),
            );
        }

        return $instance;
    }

    public function withNamespace(string $rulesNamespace): self
    {
        return new self($this->factory->withNamespace(trim($rulesNamespace, '\\')));
    }
}
