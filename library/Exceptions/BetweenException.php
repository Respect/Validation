<?php
namespace Respect\Validation\Exceptions;

class BetweenException extends AbstractNestedException
{
    const BOTH = 0;
    const LOWER = 1;
    const GREATER = 2;


    public function configure($name, array $params = array())
    {
        $params['minValue'] = static::stringify($params['minValue']);
        $params['maxValue'] = static::stringify($params['maxValue']);

        return parent::configure($name, $params);
    }

    public function chooseTemplate()
    {
        if (!$this->getParam('minValue')) {
            return static::GREATER;
        } elseif (!$this->getParam('maxValue')) {
            return static::LOWER;
        } else {
            return static::BOTH;
        }
    }
}
