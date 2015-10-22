--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Validator as v;

try {
    v::alnum()->noWhitespace()->assert('Bla %1#%&23');
} catch (AllOfException $exception) {
    echo $exception->getFullMessage();
}
?>
--EXPECTF--
- All of the required rules must pass for "Bla %1#%&23"
  - "Bla %1#%&23" must contain only letters (a-z) and digits (0-9)
  - "Bla %1#%&23" must not contain whitespace
