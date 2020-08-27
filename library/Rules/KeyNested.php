<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayAccess;
use Respect\Validation\Exceptions\ComponentException;

use function array_key_exists;
use function array_shift;
use function explode;
use function is_array;
use function is_null;
use function is_object;
use function is_scalar;
use function property_exists;
use function rtrim;
use function sprintf;

/**
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Ivan Zinovyev <vanyazin@gmail.com>
 */
final class KeyNested extends AbstractRelated
{
    /**
     * {@inheritDoc}
     */
    public function hasReference($input): bool
    {
        try {
            $this->getReferenceValue($input);
        } catch (ComponentException $cex) {
            return false;
        }

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function getReferenceValue($input)
    {
        if (is_scalar($input)) {
            $message = sprintf('Cannot select the %s in the given data', $this->getReference());
            throw new ComponentException($message);
        }

        $keys = $this->getReferencePieces();
        $value = $input;
        while (!is_null($key = array_shift($keys))) {
            $value = $this->getValue($value, $key);
        }

        return $value;
    }

    /**
     * @return string[]
     */
    private function getReferencePieces(): array
    {
        return explode('.', rtrim((string) $this->getReference(), '.'));
    }

    /**
     * @param mixed[] $array
     * @param mixed $key
     *
     * @return mixed
     */
    private function getValueFromArray(array $array, $key)
    {
        if (!array_key_exists($key, $array)) {
            $message = sprintf('Cannot select the key %s from the given array', $this->getReference());
            throw new ComponentException($message);
        }

        return $array[$key];
    }

    /**
     * @param mixed $key
     *
     * @return mixed
     */
    private function getValueFromArrayAccess(ArrayAccess $array, $key)
    {
        if (!$array->offsetExists($key)) {
            $message = sprintf('Cannot select the key %s from the given array', $this->getReference());
            throw new ComponentException($message);
        }

        return $array->offsetGet($key);
    }

    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
     *
     *
     * @return mixed
     */
    private function getValueFromObject(object $object, string $property)
    {
        if (empty($property) || !property_exists($object, $property)) {
            $message = sprintf('Cannot select the property %s from the given object', $this->getReference());
            throw new ComponentException($message);
        }

        return $object->{$property};
    }

    /**
     * @param mixed $value
     * @param mixed $key
     *
     * @return mixed
     */
    private function getValue($value, $key)
    {
        if (is_array($value)) {
            return $this->getValueFromArray($value, $key);
        }

        if ($value instanceof ArrayAccess) {
            return $this->getValueFromArrayAccess($value, $key);
        }

        if (is_object($value)) {
            return $this->getValueFromObject($value, $key);
        }

        $message = sprintf('Cannot select the property %s from the given data', $this->getReference());
        throw new ComponentException($message);
    }
}
