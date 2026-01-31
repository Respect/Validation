<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alan Taylor <alan@gtrbunny.com>
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Emmerson Siqueira <emmersonsiqueira@gmail.com>
 * SPDX-FileContributor: Fabio Ribeiro <faabiosr@gmail.com>
 * SPDX-FileContributor: Graham Campbell <graham@mineuk.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use ReflectionClass;
use ReflectionObject;
use Respect\Validation\Path;
use Respect\Validation\Result;
use Respect\Validation\Validator;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
final readonly class Property implements Validator
{
    public function __construct(
        private string $propertyName,
        private Validator $validator,
    ) {
    }

    public function evaluate(mixed $input): Result
    {
        $propertyExistsResult = (new PropertyExists($this->propertyName))->evaluate($input);
        if (!$propertyExistsResult->hasPassed) {
            return $propertyExistsResult->withNameFrom($this->validator);
        }

        return $this->validator
            ->evaluate($this->getPropertyValue($input, $this->propertyName))
            ->withPath($propertyExistsResult->path ?? new Path($this->propertyName));
    }

    private function getPropertyValue(object $object, string $propertyName): mixed
    {
        $reflection = new ReflectionObject($object);
        $value = null;
        while ($reflection instanceof ReflectionClass) {
            if ($reflection->hasProperty($propertyName)) {
                $property = $reflection->getProperty($propertyName);

                $value = $property->isInitialized($object) ? $property->getValue($object) : null;
                break;
            }

            $reflection = $reflection->getParentClass();
        }

        return $value;
    }
}
