<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Test\Stubs;

use Respect\Validation\Message\Formatter;
use Respect\Validation\Message\Stringifier\KeepOriginalStringName;
use Respect\Validation\Rules\AbstractComposite;
use Respect\Validation\Test\Exceptions\CompositeStubException;
use Respect\Validation\Validatable;

final class CompositeSub extends AbstractComposite
{
    public function validate(mixed $input): bool
    {
        return true;
    }

    /**
     * @param array<string, mixed> $extraParameters
     */
    public function reportError(mixed $input, array $extraParameters = []): CompositeStubException
    {
        return new CompositeStubException(
            input: $input,
            id: 'CompositeStub',
            params: $extraParameters,
            template: Validatable::TEMPLATE_STANDARD,
            templates: [],
            formatter: new Formatter(static fn ($value) => $value, new KeepOriginalStringName())
        );
    }
}
