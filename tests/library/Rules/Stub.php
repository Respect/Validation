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

namespace Respect\Validation\Test\Rules;

use Respect\Validation\Result;
use Respect\Validation\Rule;

/**
 * Stub to help testing.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 2.0.0
 */
final class Stub implements Rule
{
    /**
     * @var bool
     */
    public $isValid;

    /**
     * @var array
     */
    public $properties;

    /**
     * Initializes the rule.
     *
     * @param bool  $isValid
     * @param array $properties
     */
    public function __construct(bool $isValid, array $properties)
    {
        $this->isValid = $isValid;
        $this->properties = $properties;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($input): Result
    {
        return new Result($this->isValid, $input, $this->properties);
    }
}
