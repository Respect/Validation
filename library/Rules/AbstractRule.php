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

use Respect\Validation\Factory;
use Respect\Validation\Validatable;

abstract class AbstractRule implements Validatable
{
    protected $name;
    protected $template;

    public function __invoke($input)
    {
        return $this->validate($input);
    }

    public function assert($input)
    {
        if ($this->validate($input)) {
            return true;
        }

        throw $this->reportError($input);
    }

    public function check($input)
    {
        return $this->assert($input);
    }

    public function getName()
    {
        return $this->name;
    }

    public function reportError($input, array $extraParams = [])
    {
        return Factory::getDefaultInstance()->exception($this, $input, $extraParams);
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }
}
