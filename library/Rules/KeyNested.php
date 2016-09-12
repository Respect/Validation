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

use ArrayAccess;
use Respect\Validation\Exceptions\ComponentException;

class KeyNested extends AbstractRelated
{
    public function hasReference($input)
    {
        try {
            $this->getReferenceValue($input);
        } catch (ComponentException $cex) {
            return false;
        }

        return true;
    }

    private function getReferencePieces()
    {
        return explode('.', rtrim($this->reference, '.'));
    }

    private function getValueFromArray($array, $key)
    {
        if (!array_key_exists($key, $array)) {
            $message = sprintf('Cannot select the key %s from the given array', $this->reference);
            throw new ComponentException($message);
        }

        return $array[$key];
    }

    private function getValueFromObject($object, $property)
    {
        if (empty($property) || !property_exists($object, $property)) {
            $message = sprintf('Cannot select the property %s from the given object', $this->reference);
            throw new ComponentException($message);
        }

        return $object->{$property};
    }

    private function getValue($value, $key)
    {
        if (is_array($value) || $value instanceof ArrayAccess) {
            return $this->getValueFromArray($value, $key);
        }

        if (is_object($value)) {
            return $this->getValueFromObject($value, $key);
        }

        $message = sprintf('Cannot select the property %s from the given data', $this->reference);
        throw new ComponentException($message);
    }

    public function getReferenceValue($input)
    {
        if (is_scalar($input)) {
            $message = sprintf('Cannot select the %s in the given data', $this->reference);
            throw new ComponentException($message);
        }

        $keys = $this->getReferencePieces();
        $value = $input;
        while (!is_null($key = array_shift($keys))) {
            $value = $this->getValue($value, $key);
        }

        return $value;
    }
}
