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

namespace Respect\Validation\Test\Rules;

use Respect\Validation\Rules\AbstractRule;

use function array_shift;

/**
 * Stub to help testing rules.
 *
 * @since 2.0.0
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Stub extends AbstractRule
{
    /**
     * @var bool[]
     */
    public $validations;

    /**
     * @var mixed[]
     */
    public $inputs;

    /**
     * Initializes the rule.
     *
     * @param bool[] ...$validations
     */
    public function __construct(bool ...$validations)
    {
        $this->validations = $validations;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        $this->inputs[] = $input;

        return (bool) array_shift($this->validations);
    }
}
