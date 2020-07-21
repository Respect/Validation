--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ZendException;
use Respect\Validation\Validator as v;

try {
    v::zend('Hostname')->check('googlecombr');
} catch (ZendException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::zend('Hostname'))->check('google.com.br');
} catch (ZendException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::zend('Hostname')->assert('googlecombr');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::zend('Hostname'))->assert('google.com.br');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}
?>
--EXPECT--
The input does not match the expected structure for a DNS hostname
"google.com.br" must not be valid
- "googlecombr" must be valid
  - The input does not match the expected structure for a DNS hostname
  - The input appears to be a local network name but local network names are not allowed
- "google.com.br" must not be valid
