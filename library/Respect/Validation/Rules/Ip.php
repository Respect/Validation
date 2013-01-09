<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

class Ip extends AbstractRule
{

    public $ipOptions;

    public $networkRange;

    public function __construct($ipOptions=null)
    {
        if (is_int($ipOptions)) {
            $this->ipOptions = $ipOptions;
            return ;
        }

        $this->networkRange = $this->parseRange($ipOptions);
    }

    protected function parseRange($input)
    {
        if ($input === null || $input == '*' || $input == '*.*.*.*'
            || $input == '0.0.0.0-255.255.255.255')
            return null;

        $range = array('min' => null, 'max' => null);

        if (strpos($input, '-') !== false)
            list($range['min'], $range['max']) = explode('-', $input);
        elseif (strpos($input, '*') !== false) {
            $this->parseRangeUsingWildcards($input, $range);
        } elseif (strpos($input, '/') !== false) {
            $this->parseRangeUsingCidr($input, $range);
        } else
            throw new ComponentException('Invalid network range');

        if (!$this->verifyAddress($range['min'])) {
            throw new ComponentException('Invalid network range');
        }

        if (isset($range['max']) && !$this->verifyAddress($range['max'])) {
            throw new ComponentException('Invalid network range');
        }

        return $range;
    }

    protected function fillAddress(&$input, $char = '*')
    {
        while (substr_count($input, '.') < 3) {
            $input .= '.' . $char;
        }
    }

    protected function parseRangeUsingWildcards($input, &$range)
    {
        $this->fillAddress($input);

        $range['min'] = strtr($input, '*', '0');
        $range['max'] = str_replace('*', '255', $input);
    }

    protected function parseRangeUsingCidr($input, &$range)
    {
        $input = explode('/', $input);
        $this->fillAddress($input[0], '0');

        $range['min'] = $input[0];
        $isAddressMask = strpos($input[1], '.') !== false;

        if ($isAddressMask && $this->verifyAddress($input[1])) {
            $range['mask'] = ip2long($input[1]);

            return ;
        }

        if ($isAddressMask || $input[1] < 8 || $input[1] > 30) {
            throw new ComponentException('Invalid network mask');
        }

        $range['mask'] = ~ (pow(2, (32 - $input[1])) - 1);
    }

    public function validate($input)
    {
        return $this->verifyAddress($input) && $this->verifyNetwork($input);
    }

    protected function verifyAddress($address)
    {
        return (boolean) filter_var(
            $address,
            FILTER_VALIDATE_IP,
            array(
                'flags' => $this->ipOptions
            )
        );
    }

    protected function verifyNetwork($input)
    {
        if ($this->networkRange === null)
            return true;

        $input = ip2long($input);
        $range = $this->networkRange;

        if (isset($range['mask'])) {
            return ($input & $range['mask']) == (ip2long($range['min']) & $range['mask']);
        }

        return $input >= ip2long($range['min'])
                && $input <= ip2long($range['max']);
    }

}
