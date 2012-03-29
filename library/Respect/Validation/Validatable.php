<?php

namespace Respect\Validation;

/** Interface for validation rules */
interface Validatable
{
    public function assert($input);

    public function check($input);

    public function getName();

    public function reportError($input, array $relatedExceptions=array());

    public function setName($name);

    public function setTemplate($template);

    public function validate($input);
}

