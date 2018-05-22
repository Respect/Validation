--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\AllOfException;
use Respect\Validation\Exceptions\NotEmptyException;
use Respect\Validation\Validator as v;

$notEmptyValues = [
    'a',
    1,
    1.0,
];

//Check not empty values
foreach ($notEmptyValues as $value) {
    v::notEmpty()->assert($value);
    v::notEmpty()->check($value);
}

//Check a not empty array
v::notEmpty()->assert([1]);
v::notEmpty()->check([1]);

try {
    v::notEmpty()->check(null);
} catch (NotEmptyException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::notEmpty()->assert('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}

try {
    v::notEmpty()->setName('Field')->check(null);
} catch (NotEmptyException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::notEmpty()->setName('Field')->assert('');
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}

try {
    v::not(v::notEmpty())->check(1);
} catch (NotEmptyException $e) {
    echo $e->getMessage().PHP_EOL;
}

try {
    v::not(v::notEmpty())->assert([1]);
} catch (AllOfException $e) {
    echo $e->getFullMessage().PHP_EOL;
}

?>
--EXPECTF--
The value must not be empty
- The value must not be empty
Field must not be empty
- Field must not be empty
1 must be empty
- `{ 1 }` must be empty
