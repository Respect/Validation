<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Exceptions\ValidationException;

/** Interface for validation rules */
/**
 * @author Alexandre Gomes Gaigalas <alganet@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
interface Validatable
{
    /**
     * @param mixed $input
     */
    public function assert($input): void;

    /**
     * @param mixed $input
     */
    public function check($input): void;

    public function getName(): ?string;

    /**
     * @param mixed $input
     * @param mixed[] $extraParameters
     */
    public function reportError($input, array $extraParameters = []): ValidationException;

    public function setName(string $name): Validatable;

    public function setTemplate(string $template): Validatable;

    /**
     * @param mixed $input
     */
    public function validate($input): bool;
}
