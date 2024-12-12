<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Attribute;
use ReflectionAttribute;
use ReflectionObject;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Rule;
use Respect\Validation\Rules\Core\Standard;

use function is_object;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    'The properties of {{name}} must be valid',
    'The properties of {{name}} must not be valid',
    self::TEMPLATE_STANDARD
)]
#[Template(
    '{{name}} must be an object with PHP attributes',
    '{{name}} must not an object with PHP attributes',
    self::TEMPLATE_WRONG_TYPE
)]
final class Attributes extends Standard
{
    public const TEMPLATE_WRONG_TYPE = '__wrong_type__';

    public function evaluate(mixed $input): Result
    {
        if (!is_object($input)) {
            return Result::failed($input, $this, [], self::TEMPLATE_WRONG_TYPE);
        }

        $isValid = true;
        $children = [];
        foreach ((new ReflectionObject($input))->getProperties() as $property) {
            $allowsNull = $property->getType()?->allowsNull() ?? false;
            foreach ($property->getAttributes(Rule::class, ReflectionAttribute::IS_INSTANCEOF) as $attribute) {
                $childRule = $allowsNull ? new NullOr($attribute->newInstance()) : $attribute->newInstance();
                $childResult = (new Property($property->getName(), $childRule))->evaluate($input);
                $isValid = $isValid && $childResult->isValid;
                $children[] = $childResult;
            }
        }

        return (new Result($isValid, $input, $this))->withChildren(...$children);
    }
}
