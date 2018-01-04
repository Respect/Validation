--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

v::image()->assertAll('tests/fixtures/valid-image.png');
v::image()->assert(new SplFileInfo('tests/fixtures/valid-image.gif'));
?>
--EXPECTF--
