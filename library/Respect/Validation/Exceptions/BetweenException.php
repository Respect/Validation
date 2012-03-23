<?php

namespace Respect\Validation\Exceptions;

class BetweenException extends AbstractNestedException
{
    const BOTH = 0;
    const LOWER = 1;
    const GREATER = 2;

    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::BOTH => '{{name}} must be between {{minValue}} and {{maxValue}}',
            self::LOWER => '{{name}}  must be greater than {{minValue}}',
            self::GREATER => '{{name}} must be lower than {{maxValue}}',
        ),
        self::MODE_NEGATIVE => array(
            self::BOTH => '{{name}} must not be between {{minValue}} and {{maxValue}}',
            self::LOWER => '{{name}}  must not be greater than {{minValue}}',
            self::GREATER => '{{name}} must not be lower than {{maxValue}}',
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
