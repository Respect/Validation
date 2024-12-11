<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Pdp\Domain as PdpDomain;
use Respect\Validation\Exceptions\MissingComposerDependencyException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Throwable;

use function class_exists;
use function count;
use function is_string;

#[Template(
    '{{name}} must be a valid domain',
    '{{name}} must not be a valid domain',
)]
final class Domain implements Rule
{
    public function __construct(
        private readonly bool $requireTld = true,
    ) {
        if (!class_exists(PdpDomain::class)) {
            throw new MissingComposerDependencyException(
                'Domain rule requires PHP Domain Parser',
                'jeremykendall/php-domain-parser',
            );
        }
    }

    public function evaluate(mixed $input): Result
    {
        if (!is_string($input)) {
            return Result::failed($input, $this);
        }

        try {
            $domain = PdpDomain::fromIDNA2008($input);
            if (count($domain->labels()) === 1) {
                return Result::failed($input, $this);
            }

            $domain->label(0);
        } catch (Throwable) {
            return Result::failed($input, $this);
        }

        return Result::passed($input, $this);
    }
}
