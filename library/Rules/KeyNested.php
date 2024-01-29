<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ArrayAccess;
use Respect\Validation\Attributes\ExceptionClass;
use Respect\Validation\Attributes\Template;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\NonOmissibleValidationException;

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

#[ExceptionClass(NonOmissibleValidationException::class)]
#[Template(
    'No items were found for key chain {{name}}',
    'Items for key chain {{name}} must not be present',
    self::TEMPLATE_NOT_PRESENT,
)]
#[Template(
    'Key chain {{name}} is not valid',
    'Key chain {{name}} must not be valid',
    self::TEMPLATE_INVALID,
)]
final class KeyNested extends AbstractRelated
{
    public function hasReference(mixed $input): bool
    {
        try {
            $this->getReferenceValue($input);
        } catch (ComponentException $cex) {
            return false;
        }

        return true;
    }

    public function getReferenceValue(mixed $input): mixed
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
     */
    private function getValueFromArray(array $array, mixed $key): mixed
    {
        if (!array_key_exists($key, $array)) {
            $message = sprintf('Cannot select the key %s from the given array', $this->getReference());
            throw new ComponentException($message);
        }

        return $array[$key];
    }

    /**
     * @param ArrayAccess<mixed, mixed> $array
     */
    private function getValueFromArrayAccess(ArrayAccess $array, mixed $key): mixed
    {
        if (!$array->offsetExists($key)) {
            $message = sprintf('Cannot select the key %s from the given array', $this->getReference());
            throw new ComponentException($message);
        }

        return $array->offsetGet($key);
    }

    /**
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
     */
    private function getValueFromObject(object $object, string $property): mixed
    {
        if (empty($property) || !property_exists($object, $property)) {
            $message = sprintf('Cannot select the property %s from the given object', $this->getReference());
            throw new ComponentException($message);
        }

        return $object->{$property};
    }

    private function getValue(mixed $value, mixed $key): mixed
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
