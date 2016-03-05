--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Rules\LanguageCode;
use Respect\Validation\Validator as v;

v::languageCode()->assert('pt');
v::languageCode()->assert('en');
v::languageCode()->assert('it');

v::languageCode()->check('pt');
v::languageCode()->check('en');
v::languageCode()->check('it');

v::languageCode('alpha-3')->assert('por');
v::languageCode('alpha-3')->assert('eng');
v::languageCode('alpha-3')->assert('ita');

v::languageCode('alpha-3')->check('por');
v::languageCode('alpha-3')->check('eng');
v::languageCode('alpha-3')->check('ita');
?>
--EXPECTF--
