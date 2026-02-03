<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Respect\Validation\ContainerRegistry;
use Respect\Validation\Exceptions\ValidationException;
use Respect\Validation\ValidatorBuilder;

final class MyValidator
{
    public static function assertIntType(mixed $input): void
    {
        $defaultContainer = ContainerRegistry::getContainer();

        $container = ContainerRegistry::createContainer();
        $container->set('respect.validation.ignored_backtrace_paths', [
            __FILE__,
            ...$defaultContainer->get('respect.validation.ignored_backtrace_paths'),
        ]);
        ContainerRegistry::setContainer($container);

        try {
            ValidatorBuilder::intType()->assert($input);
        } catch (ValidationException $exception) {
            // This is a workaround to avoid changing exceptions that are thrown in other places.
            ContainerRegistry::setContainer($defaultContainer);

            throw $exception;
        }
    }
}
