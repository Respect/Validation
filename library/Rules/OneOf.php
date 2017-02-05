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
 * Will validate if exactly one inner validator passes.
 *
 * @author Bradyn Poulsen <bradyn@bradynpoulsen.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 2.0.0
 */
final class OneOf implements Rule
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
        $validCount = 0;
        $childrenResults = [];
        foreach ($this->rules as $key => $rule) {
            $childResult = $rule->apply($input);

            $childrenResults[$key] = $childResult;

            if (!$childResult->isValid()) {
                continue;
            }

            if ($validCount >= 1) {
                $childrenResults[$key] = $childResult->invert();
            }

            ++$validCount;
        }

        return new Result((1 === $validCount), $input, $this, [], ...$childrenResults);
    }
}
