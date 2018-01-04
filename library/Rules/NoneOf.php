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

use Respect\Validation\Result;
use Respect\Validation\Rule;

/**
 * Validates if none of the given validators validate.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class NoneOf implements Rule
{
    /**
     * @var Rule[]
     */
    private $rules = [];

    /**
     * Initializes the rule.
     *
     * @param Rule $rule
     * @param Rule ...$rule2
     */
    public function __construct(Rule ...$rule)
    {
        $this->rules = $rule;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($input): Result
    {
        $isValid = true;
        $childrenResults = [];
        foreach ($this->rules as $rule) {
            $childResult = $rule
                ->apply($input)
                ->invert();

            $isValid = $isValid && $childResult->isValid();
            $childrenResults[] = $childResult;
        }

        return new Result($isValid, $input, $this, [], ...$childrenResults);
    }
}
