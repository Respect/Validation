<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation;

use Respect\Validation\Exceptions\ValidationException;

/** Interface for validation rules */
interface Validatable
{
    /**
     * @param mixed $input
     * @return bool|ValidationException
     */
    public function assert($input);

    /**
     * @param mixed $input
     * @return bool|ValidationException
     */
    public function check($input);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param mixed $input
     * @param array $relatedExceptions = []
     * @return bool|ValidationException
     */
    public function reportError($input, array $relatedExceptions = []);

    /**
     * @param string $name
     * @return Validatable
     */
    public function setName($name);

    /**
     * @param string $template
     * @return Validatable
     */
    public function setTemplate($template);

    /**
     * @param mixed $input
     * @return bool
     */
    public function validate($input);
}
