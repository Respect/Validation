--FILE--
<?php
require 'vendor/autoload.php';

date_default_timezone_set('UTC');

use Respect\Validation\Validator as v;

v::MinimumAge(12, 'd/m/Y')->check('12/10/1999');

?>
--EXPECTF--
