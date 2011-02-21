<?php

namespace Respect\Validation;

use Respect\Validation\Exceptions\ValidationException;

/**
 * @method Validator int() int() integer
 */
interface Validatable
{

    public function assert($input);

    public function check($input);

    public function getName();

    public function reportError($input, array $relatedExceptions=array());

    public function setName($name);

    public function validate($input);
}

