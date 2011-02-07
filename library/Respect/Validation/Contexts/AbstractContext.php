<?php

namespace Respect\Validation\Contexts;

use Respect\Validation\Exceptions\ValidationException;

abstract class AbstractContext
{

    public $defaultTemplates = array();

    public function getTemplate(ValidationException $e, $templateKey)
    {
        $exceptionKey = get_class($e);
        if (!isset($this->defaultTemplates[$exceptionKey])
            || !isset($this->defaultTemplates[$exceptionKey][$templateKey]))
            return $e::$defaultTemplates[$templateKey];
        else
            return $this->defaultTemplates[$exceptionKey][$templateKey];
    }

}