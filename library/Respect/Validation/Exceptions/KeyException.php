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
        if (!$theAttribute)
            return 0;
        else
            return 1;
    }

}