<?php
namespace Respect\Validation\Country;

class Brasil implements ICountry {
	private $uf = array('AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO');

	public function getUF(){
		return $this->uf;
	}
}