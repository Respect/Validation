<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;

class Type extends AbstractRule
{
    public $type;
    public $availableTypes = array(
        'array'     => 'array',
        'bool'      => 'boolean',
        'boolean'   => 'boolean',
        'callable'  => 'callable',
        'double'    => 'double',
        'float'     => 'double',
        'int'       => 'integer',
        'integer'   => 'integer',
        'null'      => 'NULL',
        'object'    => 'object',
        'resource'  => 'resource',
        'string'    => 'string',
    );

    public function __construct($type)
    {
        $lowerType = strtolower($type);
        if (!isset($this->availableTypes[$lowerType])) {
            throw new ComponentException(sprintf('"%s" is not a valid type', print_r($type, true)));
        }

        $this->type = $type;
    }

    public function validate($input)
    {
        $lowerType = strtolower($this->type);
        if ('callable' === $lowerType) {
            return is_callable($input);
        }

        return ($this->availableTypes[$lowerType] === gettype($input));
    }
}
