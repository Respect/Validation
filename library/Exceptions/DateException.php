<?php
namespace Respect\Validation\Exceptions;

class DateException extends ValidationException
{
    const FORMAT = 1;


    public function configure($name, array $params = array())
    {
        $params['format'] = date(
            $params['format'],
            strtotime('2005-12-30 01:02:03')
        );

        return parent::configure($name, $params);
    }

    public function chooseTemplate()
    {
        return $this->getParam('format') ? static::FORMAT : static::STANDARD;
    }
}
