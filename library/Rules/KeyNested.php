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
        return explode('.', $this->reference);
    }

    private function getReferenceArrayValue($input)
    {
        $keys = $this->getReferencePieces();
        $value = $input;

        while (!is_null($key = array_shift($keys))) {
            if (!array_key_exists($key, $value)) {
                $message = sprintf('Cannot select the key %s from the given array', $this->reference);
                throw new ComponentException($message);
            }

            $value = $value[$key];
        }

        return $value;
    }

    private function getReferenceObjectValue($input)
    {
        $properties = $this->getReferencePieces();
        $value = $input;

        while (!is_null($property = array_shift($properties)) &&
            '' != $property
        ) {
            if (!is_object($value) || !property_exists($value, $property)) {
                $message = sprintf('Cannot select the property %s from the given object', $this->reference);
                throw new ComponentException($message);
            }

            $value = $value->$property;
        }

        return $value;
    }

    public function getReferenceValue($input)
    {
        if (is_array($input) || $input instanceof ArrayAccess) {
            return $this->getReferenceArrayValue($input);
        }

        if (is_object($input)) {
            return $this->getReferenceObjectValue($input);
        }

        $message = sprintf('Cannot select the %s in the given data', $this->reference);
        throw new ComponentException($message);
    }
}
