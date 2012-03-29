<?php

namespace Respect\Validation\Exceptions;

class LengthException extends ValidationException
{
    const BOTH = 0;
    const LOWER = 1;
    const GREATER = 2;

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::BOTH => '{{name}} must have a length between {{minValue}} and {{maxValue}}',
            self::LOWER => '{{name}} must have a length greater than {{minValue}}',
            self::GREATER => '{{name}} must have a length lower than {{maxValue}}',
        ),
        self::MODE_NEGATIVE => array(
            self::BOTH => '{{name}} must not have a length between {{minValue}} and {{maxValue}}',
            self::LOWER => '{{name}} must not have a length greater than {{minValue}}',
            self::GREATER => '{{name}} must not have a length lower than {{maxValue}}',
        )
    );

    public function configure($name, array $params=array())
    {
        $params['minValue'] = static::stringify($params['minValue']);
        $params['maxValue'] = static::stringify($params['maxValue']);
        return parent::configure($name, $params);
    }

    public function chooseTemplate()
    {
        if (!$this->getParam('minValue'))
            return static::GREATER;
        elseif (!$this->getParam('maxValue'))
            return static::LOWER;
        else
            return static::BOTH;
    }

}

