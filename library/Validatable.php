<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Exceptions\ValidationException;

/** Interface for validation rules */
interface Validatable
{
    public function assert($input): void;

    public function check($input): void;

    public function getName(): ?string;

    public function reportError($input, array $extraParameters = []): ValidationException;

    public function setName(string $name): Validatable;

    public function setTemplate(string $template): Validatable;

    public function validate($input): bool;
}
