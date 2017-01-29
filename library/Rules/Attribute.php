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

use ReflectionProperty;
use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Rule;

/**
 * Validates an object attribute.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class Attribute extends AbstractRelated
{
    /**
     * Initializes the rule.
     *
     * @param string $attributeName
     * @param Rule   $rule
     * @param bool   $mandatory
     */
    public function __construct(string $attributeName, Rule $rule = null, bool $mandatory = true)
    {
        if ('' === $attributeName) {
            throw new ComponentException('Attribute name cannot be empty');
        }

        parent::__construct($attributeName, $rule, $mandatory);
    }

    /**
     * Get the value of attribute in the object object even when the attribute is private.
     *
     * @param object $object
     * @param string $attributeName
     *
     * @return mixed
     */
    public function getReferenceValue($object, $attributeName)
    {
        $attributeMirror = new ReflectionProperty($object, $attributeName);
        $attributeMirror->setAccessible(true);

        return $attributeMirror->getValue($object);
    }

    /**
     * Verifies if the input is an object and if it has the attribute.
     *
     * @param object $object
     * @param string $attributeName
     *
     * @return bool
     */
    public function hasReference($object, $attributeName): bool
    {
        return is_object($object) && property_exists($object, $attributeName);
    }
}
