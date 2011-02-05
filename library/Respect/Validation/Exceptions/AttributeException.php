<?php

namespace Respect\Validation\Exceptions;

class AttributeException extends AbstractRelatedException
{

    public static $defaultTemplates = array(
        '"%2$s" is not present',
        '"%2$s" is invalid',
    );

    public function chooseTemplate($input, $attributeName, $hasTheAttribute)
    {
        return $hasTheAttribute ? 1 : 0;
    }

}