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

use function call_user_func;

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
    public $callback;

    /**
     * @var array
     */
    public $arguments;

    /**
     * Initializes the rule.
     *
     * @param callable $callback
     * @param mixed ...$arguments
     */
    public function __construct(callable $callback, ...$arguments)
    {
        $this->callback = $callback;
        $this->arguments = $arguments;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        return (bool) call_user_func($this->callback, $input, ...$this->arguments);
    }
}
