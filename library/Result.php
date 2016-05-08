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

namespace Respect\Validation;

use function count;

/**
 * Handles validation's results.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 2.0.0
 */
final class Result
{
    const TEMPLATE_KEY = '__id';

    /**
     * @var bool
     */
    private $isValid;

    /**
     * @var mixed
     */
    private $input;

    /**
     * @var Rule
     */
    private $rule;

    /**
     * @var Result[]
     */
    private $children;

    /**
     * @var array
     */
    private $properties;

    /**
     * @var bool
     */
    private $isInverted = false;

    /**
     * Initializes the object.
     *
     * @param bool   $isValid
     * @param mixed  $input
     * @param Rule   $rule
     * @param array  $properties
     * @param Result $child
     * @param Result ...$child2
     */
    public function __construct(bool $isValid, $input, Rule $rule, array $properties = [], self ...$child)
    {
        $this->isValid = $isValid;
        $this->input = $input;
        $this->rule = $rule;
        $this->properties = $properties;
        $this->children = $child;
    }

    /**
     * Returns whether the result is valid or not.
     *
     * @return bool
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * Returns the input that was used on the validation.
     *
     * @return mixed
     */
    public function getInput()
    {
        return $this->input;
    }

    /**
     * Returns the rule that performed the validation.
     *
     * @return Rule
     */
    public function getRule(): Rule
    {
        return $this->rule;
    }

    /**
     * Returns the children of the result.
     *
     * @return Result[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    /**
     * Returns the properties of the result.
     *
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * Returns whether the result is inverted or not.
     *
     * @return bool
     */
    public function isInverted(): bool
    {
        return $this->isInverted;
    }

    /**
     * Creates a new object with the inverted validation.
     *
     * @return Result
     */
    public function invert(): self
    {
        $result = clone $this;
        $result->isValid = !$result->isValid;
        $result->isInverted = !$result->isInverted;

        return $result;
    }

    public function hasChildren(): bool
    {
        return count($this->children) > 0;
    }
}
