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

use function array_shift;
use function array_unshift;
use function call_user_func_array;
use function func_get_args;

/**
 * This is a wildcard validator, it uses a function name, method or closure.
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
class Callback extends AbstractRule
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
     * @param callable $callback
     */
    public function __construct(callable $callback, ...$arguments)
    {
        $arguments = func_get_args();
        array_shift($arguments);

        $this->callback = $callback;
        $this->arguments = $arguments;
    }

    /**
     * {@inheritdoc}
     */
    public function validate($input): bool
    {
        $params = $this->arguments;
        array_unshift($params, $input);

        return (bool) call_user_func_array($this->callback, $params);
    }
}
