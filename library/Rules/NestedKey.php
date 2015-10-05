<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Validatable;

class NestedKey extends AbstractRelated
{
    public function __construct($reference, Validatable $referenceValidator = null, $mandatory = true)
    {
        if (!$reference) {
            throw new ComponentException('Invalid array key');
        }
        parent::__construct($reference, $referenceValidator, $mandatory);
    }

    public function hasReference($input)
    {
        return !!$this->getReferenceValue($input);
    }

    public function getReferenceValue($input)
    {
        $type = gettype($input);
        if (false === $pos = strpos($this->reference, '.')) {
            if ('array' === $type && array_key_exists($this->reference, $input)) {
                return $input[$this->reference];
            } elseif ('object' === $type && property_exists($input, $this->reference)) {
                return $input->{$this->reference};
            } else {
                throw new ComponentException(sprintf(
                    'Can not select the key %s from the variable of type %s',
                    $this->reference,
                    $type
                ));
            }
        } else {
            $leftKey = substr($this->reference, 0, $pos);
            $rightKey = substr($this->reference, $pos + 1);

            if ('array' === $type && array_key_exists($leftKey, $input)) {
                if ($rightKey) {
                    $nestedKey = new static($rightKey, $this->validator, $this->mandatory);
                    return $nestedKey->getReferenceValue($input[$leftKey]);
                } else {
                    return $input[$leftKey];
                }
            } elseif ('object' === $type && property_exists($input, $leftKey)) {
                if ($rightKey) {
                    $nestedKey = new static($rightKey, $this->validator, $this->mandatory);
                    return $nestedKey->getReferenceValue($input->{$leftKey});
                } else {
                    return $input->{$leftKey};
                }
            } else {
                throw new ComponentException(sprintf(
                    'Can not select the key %s from the variable of type %s',
                    $leftKey,
                    $type
                ));
            }
        }
    }
}