--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::MinimumAge(12, 'd/m/Y')->assert('12/10/2010');
} catch (AllOfException $exception) {
    echo $exception->getFullMessage();
}

?>
--EXPECTF--
\-The age must be 12 years or more.