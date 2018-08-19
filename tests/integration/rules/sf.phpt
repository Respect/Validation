--FILE--
<?php
require 'vendor/autoload.php';

use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Exceptions\SfException;
use Respect\Validation\Validator as v;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsNull;

try {
    v::sf(new IsNull())->check('something');
} catch (SfException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::not(v::sf(new IsNull()))->check(null);
} catch (SfException $exception) {
    echo $exception->getMessage().PHP_EOL;
}

try {
    v::sf(new Email())->assert('not-null');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::not(v::sf(new Email()))->assert('example@example.com');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage().PHP_EOL;
}

try {
    v::sf(
        new Collection([
            'first' => new IsNull(),
            'second' => new Email(),
        ])
    )->check(['second' => 'not-email']);
} catch (SfException $exception) {
    echo $exception->getMessage();
}
?>
--EXPECTF--
This value should be null.
`NULL` must not be valid for `[object] (Symfony\Component\Validator\Constraints\IsNull: { %s })`
- This value is not a valid email address.
- "example@example.com" must not be valid for `[object] (Symfony\Component\Validator\Constraints\Email: { %s })`
Array[first]:
    This field is missing. (code %s)
Array[second]:
    This value is not a valid email address. (code %s)
