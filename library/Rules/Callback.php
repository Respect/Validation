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

namespace Respect\Validation\Rules;

use function array_merge;
use function call_user_func_array;
use function count;

/**
 * Validates the input using the return of a given callable.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class Callback extends AbstractRule
{
    /**
     * @var callable
     */
    private $callback;

    /**
     * @var mixed[]
     */
    private $arguments;

    /**
     * Initializes the rule.
     *
     * @param mixed ...$arguments
     */
    public function __construct(callable $callback, ...$arguments)
    {
        $this->callback = $callback;
        $this->arguments = $arguments;
    }

    /**
     * {@inheritDoc}
     */
    public function validate($input): bool
    {
        $arguments = [$input];
        if (count($this->arguments) > 0) {
            $arguments = array_merge($arguments, $this->arguments);
        }

        return (bool) call_user_func_array($this->callback, $arguments);
    }
}
