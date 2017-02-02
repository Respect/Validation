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
use Respect\Validation\Rule;

/**
 * Validates an array key or an object property using `.` to represent nested data.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ivan Zinovyev <vanyazin@gmail.com>
 *
 * @since 1.0.0
 */
final class KeyNested extends AbstractRelated
{
    /**
     * Initializes the rule.
     *
     * @param string $reference
     * @param Rule   $rule
     * @param bool   $mandatory
     */
    public function __construct(string $reference, Rule $rule = null, bool $mandatory = true)
    {
        parent::__construct($reference, $rule, $mandatory);
    }

    /**
     * Verifies if the input has the reference.
     *
     * @param mixed  $input
     * @param string $reference
     *
     * @return bool
     */
    protected function hasReference($input, $reference): bool
    {
        try {
            $this->getReferenceValue($input, $reference);
        } catch (ComponentException $exceptions) {
            return false;
        }

        return true;
    }

    /**
     * Get the value for the reference on the input.
     *
     * @param mixed  $input
     * @param string $reference
     *
     * @throws ComponentException When the value cannot be fetch
     *
     * @return mixed
     */
    protected function getReferenceValue($input, $reference)
    {
        if (is_scalar($input)) {
            $message = sprintf('Cannot select the %s in the given data', $reference);
            throw new ComponentException($message);
        }

        $keys = explode('.', rtrim($reference, '.'));
        $value = $input;
        while (!is_null($key = array_shift($keys))) {
            $value = $this->getValue($reference, $value, $key);
        }

        return $value;
    }

    private function getValue(string $reference, $value, string $key)
    {
        if (is_array($value) || $value instanceof ArrayAccess) {
            return $this->getValueFromArray($reference, $value, $key);
        }

        if (is_object($value)) {
            return $this->getValueFromObject($reference, $value, $key);
        }

        $message = sprintf('Cannot select the reference %s from the given data', $reference);
        throw new ComponentException($message);
    }

    private function getValueFromArray(string $reference, $array, string $key)
    {
        if ((is_array($array) && !array_key_exists($key, $array))
            || !isset($array[$key])) {
            $message = sprintf('Cannot select the key %s from the given array', $reference);
            throw new ComponentException($message);
        }

        return $array[$key];
    }

    private function getValueFromObject(string $reference, $object, string $property)
    {
        if (empty($property) || !property_exists($object, $property)) {
            $message = sprintf('Cannot select the property %s from the given object', $reference);
            throw new ComponentException($message);
        }

        return $object->{$property};
    }
}
