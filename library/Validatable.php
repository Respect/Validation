<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation;

use Respect\Validation\Exceptions\ValidationException;

/** Interface for validation rules */
/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
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
