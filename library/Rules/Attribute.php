<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use ReflectionException;
use ReflectionProperty;
use Respect\Validation\Validatable;

/**
 * Validates an object attribute, event private ones.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Attribute extends AbstractRelated
{
    public function __construct(string $reference, Validatable $validator = null, $mandatory = true)
    {
        parent::__construct($reference, $validator, $mandatory);
    }

    /**
     * @param object $input
     *
     * @throws ReflectionException
     *
     * @return mixed
     */
    public function getReferenceValue($input)
    {
        $propertyMirror = new ReflectionProperty($input, $this->reference);
        $propertyMirror->setAccessible(true);

        return $propertyMirror->getValue($input);
    }

    /**
     * @param object $input
     */
    public function hasReference($input): bool
    {
        return is_object($input) && property_exists($input, $this->reference);
    }
}
