<?php

require '../vendor/autoload.php';

use Respect\Validation\Rules as r;
use Respect\Validation\Country as c;

$country = new r\UF( new c\Brasil() );
$isSigla = $country->validate('SC');

var_dump($isSigla);