<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;
use Respect\Validation\Exceptions\AlwaysInvalidException;

class When extends AbstractRule
{
    public $when;
    public $then;
    public $else;

    public function __construct(Validatable $when, Validatable $then, Validatable $else = null)
    {
        $this->when = $when;
        $this->then = $then;
        if (null === $else) {
            $else = new AlwaysInvalid();
            $else->setTemplate(AlwaysInvalidException::SIMPLE);
        }

        $this->else = $else;
    }

    public function validate($input)
    {
        if ($this->when->validate($input)) {
            return $this->then->validate($input);
        }

        return $this->else->validate($input);
    }

    public function assert($input)
    {
        if ($this->when->validate($input)) {
            return $this->then->assert($input);
        }

        return $this->else->assert($input);
    }

    public function check($input)
    {
        if ($this->when->validate($input)) {
            return $this->then->check($input);
        }

        return $this->else->check($input);
    }
}
