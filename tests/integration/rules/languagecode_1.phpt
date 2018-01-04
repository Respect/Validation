--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Rules\LanguageCode;
use Respect\Validation\Validator as v;

v::languageCode()->assertAll('pt');
v::languageCode()->assertAll('en');
v::languageCode()->assertAll('it');

v::languageCode()->assert('pt');
v::languageCode()->assert('en');
v::languageCode()->assert('it');

v::languageCode('alpha-3')->assertAll('por');
v::languageCode('alpha-3')->assertAll('eng');
v::languageCode('alpha-3')->assertAll('ita');

v::languageCode('alpha-3')->assert('por');
v::languageCode('alpha-3')->assert('eng');
v::languageCode('alpha-3')->assert('ita');
?>
--EXPECTF--
