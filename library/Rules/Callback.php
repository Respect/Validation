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

use Respect\Validation\Exceptions\ComponentException;

class Callback extends AbstractRule
{
    public $callback;
    public $arguments;

    public function __construct($callback)
    {
        if (!is_callable($callback)) {
            throw new ComponentException('Invalid callback');
        }

        $arguments = func_get_args();
        array_shift($arguments);

        $this->callback = $callback;
        $this->arguments = $arguments;
    }

    public function validate($input)
    {
        $params = $this->arguments;
        array_unshift($params, $input);

        return (bool) call_user_func_array($this->callback, $params);
    }
}
