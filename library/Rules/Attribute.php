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

use ReflectionException;
use ReflectionProperty;
use Respect\Validation\Validatable;

use function is_object;
use function property_exists;

/**
 * Validates an object attribute, event private ones.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Attribute extends AbstractRelated
{
    public function __construct(string $reference, ?Validatable $rule = null, bool $mandatory = true)
    {
        parent::__construct($reference, $rule, $mandatory);
    }

    /**
     * {@inheritDoc}
     *
     * @throws ReflectionException
     */
    public function getReferenceValue($input)
    {
        $propertyMirror = new ReflectionProperty($input, (string) $this->getReference());
        $propertyMirror->setAccessible(true);

        return $propertyMirror->getValue($input);
    }

    /**
     * {@inheritDoc}
     */
    public function hasReference($input): bool
    {
        return is_object($input) && property_exists($input, (string) $this->getReference());
    }
}
