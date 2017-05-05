<?php
namespace Respect\Validation\Rules;

use Respect\Validation\Country\ICountry;

class UF extends AbstractRule
{
	private $country;

	public function __construct(ICountry $country){
		$this->country = $country;
	}

    public function validate($input)
    {
        return in_array($input, $this->country->getUF());
    }
}