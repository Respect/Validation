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

use Respect\Validation\Exceptions\ComponentException;
use function gettype;
use function is_callable;
use function mb_strtolower;
use function print_r;
use function sprintf;

/**
 * Validates the type of input.
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari<paulkarikari1@gmail.com>
 */
final class Type extends AbstractRule
{
    /**
     * Type to validate input against.
     *
     * @var string
     */
    private $type;

    /**
     * Collection of available types for validation.
     *
     * @var array
     */
    private $availableTypes = [
        'array' => 'array',
        'bool' => 'boolean',
        'boolean' => 'boolean',
        'callable' => 'callable',
        'double' => 'double',
        'float' => 'double',
        'int' => 'integer',
        'integer' => 'integer',
        'null' => 'NULL',
        'object' => 'object',
        'resource' => 'resource',
        'string' => 'string',
    ];

    /**
     * Creates new Type rule instance.
     *
     * @param string $type
     */
    public function __construct(string $type)
    {
        $lowerType = mb_strtolower($type);
        if (!isset($this->availableTypes[$lowerType])) {
            throw new ComponentException(sprintf('"%s" is not a valid type', print_r($type, true)));
        }

        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        $lowerType = mb_strtolower($this->type);
        if ('callable' === $lowerType) {
            return is_callable($input);
        }

        return $this->availableTypes[$lowerType] === gettype($input);
    }
}
