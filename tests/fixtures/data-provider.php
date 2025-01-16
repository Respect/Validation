<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

use Respect\Validation\Test\Stubs\WithAttributes;
use Respect\Validation\Test\Stubs\WithProperties;
use Respect\Validation\Test\Stubs\WithStaticProperties;
use Respect\Validation\Test\Stubs\WithUninitialized;

return [
    'null' => [
        'value' => [null],
        'tags' => ['nullType', 'empty', 'undefined'],
    ],

    // BooleanTypes
    'false' => [
        'value' => [false],
        'tags' => ['boolType', 'false', 'empty'],
    ],
    'true' => [
        'value' => [true],
        'tags' => ['boolType', 'true'],
    ],

    // IntegerTypes
    'zero integer' => [
        'value' => [0],
        'tags' => ['intType', 'zero'],
    ],
    'positive integer' => [
        'value' => [PHP_INT_MAX],
        'tags' => ['intType', 'positive'],
    ],
    'negative integer' => [
        'value' => [PHP_INT_MIN],
        'tags' => ['intType', 'negative'],
    ],

    // StringTypes
    'string' => [
        'value' => ['string'],
        'tags' => ['stringType'],
    ],
    'empty string' => [
        'value' => [''],
        'tags' => ['stringType', 'empty', 'undefined'],
    ],
    'integer string' => [
        'value' => ['500'],
        'tags' => ['stringType', 'intVal', 'positive'],
    ],
    'float string' => [
        'value' => ['56.8'],
        'tags' => ['stringType', 'floatVal', 'positive'],
    ],
    'zero string' => [
        'value' => ['0'],
        'tags' => ['stringType', 'intVal', 'zero'],
    ],

    // Float types
    'zero float' => [
        'value' => [0.0],
        'tags' => ['floatType', 'zero'],
    ],
    'positive float' => [
        'value' => [32.890],
        'tags' => ['floatType', 'positive'],
    ],
    'negative float' => [
        'value' => [-893.1],
        'tags' => ['floatType', 'negative'],
    ],

    // Array types
    'array list' => [
        'value' => [[4, 5, 6]],
        'tags' => ['arrayType', 'iterableType', 'countable'],
    ],
    'array associative with string keys' => [
        'value' => [['broccoli' => 89, 'spinach' => 123, 'beets' => 90]],
        'tags' => ['arrayType', 'iterableType', 'countable'],
    ],
    'array associative with int keys' => [
        'value' => [[1 => 'cauliflower', 2 => 'eggplant', 3 => 'asparagus']],
        'tags' => ['arrayType', 'iterableType', 'countable'],
    ],
    'empty array' => [
        'value' => [[]],
        'tags' => ['arrayType', 'iterableType', 'countable', 'empty'],
    ],

    // Array values
    'ArrayObject' => [
        'value' => [new ArrayObject([1, 2, 3])],
        'tags' => ['objectType', 'iterableType', 'ArrayObject', 'countable', 'withoutAttributes'],
    ],
    'empty ArrayObject' => [
        'value' => [new ArrayObject([])],
        'tags' => ['objectType', 'iterableType', 'ArrayObject', 'countable', 'empty', 'withoutAttributes'],
    ],

    // Iterable types
    'generator' => [
        'value' => [(static fn() => yield 7)()], // phpcs:ignore
        'tags' => ['objectType', 'iterableType', 'generator', 'withoutAttributes'],
    ],
    'empty generator' => [
        'value' => [(static fn() => yield from [])()],
        'tags' => ['objectType', 'iterableType', 'generator', 'empty', 'withoutAttributes'],
    ],

    // Callable types
    'closure' => [
        'value' => [static fn() => 'foo'],
        'tags' => ['objectType', 'callable', 'withoutAttributes'],
    ],

    // Object types
    'object' => [
        'value' => [new stdClass()],
        'tags' => ['objectType', 'withoutAttributes'],
    ],
    'object with properties' => [
        'value' => [new WithProperties()],
        'tags' => ['objectType', 'withoutAttributes'],
    ],
    'object with uninitialized properties' => [
        'value' => [new WithUninitialized()],
        'tags' => ['objectType', 'withoutAttributes'],
    ],
    'object with static properties' => [
        'value' => [new WithStaticProperties()],
        'tags' => ['objectType', 'withoutAttributes'],
    ],
    'object with Rule attributes' => [
        'value' => [new WithAttributes('John Doe', '1912-06-23', 'john.doe@gmail.com')],
        'tags' => ['objectType', 'withAttributes'],
    ],
    'anonymous class' => [
        'value' => [new class {
        },
        ],
        'tags' => ['objectType', 'withoutAttributes'],
    ],

    // Resource types
    'stream-context resource' => [
        'value' => [stream_context_create()],
        'tags' => ['resourceType'],
    ],
    'stream resource' => [
        'value' => [tmpfile()],
        'tags' => ['resourceType'],
    ],

    // Closed resource (is not a resourceType)
    'resource (closed)' => [
        'value' => [
            (static function () {
                $resource = tmpfile();
                if ($resource === false) {
                    throw new RuntimeException('Failed to create temporary file.');
                }
                fclose($resource);

                return $resource;
            })(),
        ],
        'tags' => ['closedResource'],
    ],
];
