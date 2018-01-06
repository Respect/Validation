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

use function array_shift;
use Respect\Validation\Rules\AbstractRule;

/**
 * Stub to help testing rules.
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 2.0.0
 */
final class Stub extends AbstractRule
{
    /**
     * @var array
     */
    public $validations;

    /**
     * @var array
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
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        $this->inputs[] = $input;

        return (bool) array_shift($validations);
    }
}
