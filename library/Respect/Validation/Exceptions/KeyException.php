<?php

namespace Respect\Validation\Exceptions;

class KeyException extends AbstractRelatedException
{
    public static $defaultTemplates = array(
        '"%2$s" is not present',
        '"%2$s" is invalid',
    );

    public function chooseTemplate($input, $attributeName, $theAttribute)
    {
        return $theAttribute ? 0 : 1;
    }

}