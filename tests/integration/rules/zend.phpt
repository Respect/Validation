--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\ZendException;
use Respect\Validation\Validator as v;
use Zend\Validator\Date;

try {
    v::zend('Hostname')->check('googlecombr');
} catch (ZendException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::zend('Hostname'))->check('google.com.br');
} catch (ZendException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::zend('Hostname')->assert('googlecombr');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::zend('Hostname'))->assert('google.com.br');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::zend(123)->check(123);
} catch (ComponentException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

var_dump(v::zend('Zend\Validator\Date')->validate('2019-02-5'));
var_dump(v::zend('Date')->validate('2019-02-5'));
var_dump(v::zend(new Date())->validate('2019-02-5'));
var_dump(v::zend(new Date())->assert('2019-02-5'));
var_dump(v::zend(new Date())->validate([]));

?>
--EXPECT--
"googlecombr"
"google.com.br"
- "googlecombr"
  - "The input does not match the expected structure for a DNS hostname"
  - "The input appears to be a local network name but local network names are not allowed"
- "google.com.br"
Invalid Validator Construct
bool(true)
bool(true)
bool(true)
NULL
bool(false)
