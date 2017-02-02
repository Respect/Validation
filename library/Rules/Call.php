<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\Result;
use Respect\Validation\Rule;

/**
 * Executes a callable for the input and then validates its return.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class Call implements Rule
{
    /**
     * @var callable
     */
    private $callable;

    /**
     * @var Rule
     */
    private $rule;

    /**
     * Initializes the rule.
     *
     * @param callable $callable
     * @param Rule     $rule
     */
    public function __construct(callable $callable, Rule $rule)
    {
        $this->callable = $callable;
        $this->rule = $rule;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): Result
    {
        $return = call_user_func($this->callable, $input);
        $returnResult = $this->rule->validate($return);

        return new Result($returnResult->isValid(), $input, $this, [], $returnResult);
    }
}
