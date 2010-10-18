<?php

namespace Respect\Validation;

interface Validatable
{

    public function assert($input);

    public function validate($input);

    public function check($input);
}