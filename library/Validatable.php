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

/** Interface for validation rules */
interface Validatable
{
    public function assert($input);

    public function check($input);

    public function getName();

    public function reportError($input, array $relatedExceptions = []);

    public function setName($name);

    public function setTemplate($template);

    public function validate($input);
}
