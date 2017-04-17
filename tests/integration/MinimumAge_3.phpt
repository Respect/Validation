--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\MinimumAgeException;

v::MinimumAge(12, 'd/m/Y')->check('12/10/1999');

?>
--EXPECTF--
