<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Validatable;

class When extends AbstractRule
{
	public $when;
	public $then;
	public $else;

    public function __construct(Validatable $when, Validatable $then, Validatable $else)
    {
    	$this->when = $when;
    	$this->then = $then;
    	$this->else = $else;
    }

    public function validate($input)
    {
    	if ($this->when->validate($input))
    		return $this->then->validate($input);
    	else
    		return $this->else->validate($input);
    }

    public function assert($input)
    {
    	if ($this->when->validate($input))
    		return $this->then->assert($input);
    	else
    		return $this->else->assert($input);
    }

    public function check($input)
    {
    	if ($this->when->validate($input))
    		return $this->then->check($input);
    	else
    		return $this->else->check($input);
    }

}

