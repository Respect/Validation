<?php
namespace Respect\Validation\Exceptions;

class IpException extends ValidationException
{
    const STANDARD = 0;
    const NETWORK_RANGE = 1;


    public function configure($name, array $params = array())
    {
        if ($params['networkRange']) {
            $range = $params['networkRange'];
            $message = $range['min'];

            if (isset($range['max'])) {
                $message .= '-'.$range['max'];
            } else {
                $message .= '/'.long2ip($range['mask']);
            }

            $params['range'] = $message;
        }

        return parent::configure($name, $params);
    }

    public function chooseTemplate()
    {
        if (!$this->getParam('networkRange')) {
            return static::STANDARD;
        } else {
            return static::NETWORK_RANGE;
        }
    }
}
