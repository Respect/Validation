--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Validator as v;

$object = new stdClass();
$object->foo = true;
$object->bar = 42;

exceptionMessage(static fn() => v::attribute('baz')->assert($object));
exceptionMessage(static fn() => v::not(v::attribute('foo'))->assert($object));
exceptionMessage(static fn() => v::attribute('foo', v::falseVal())->assert($object));
exceptionMessage(static fn() => v::not(v::attribute('foo', v::trueVal()))->assert($object));
exceptionMessage(static fn() => v::attribute('foo', v::falseVal(), true)->assert($object));
exceptionMessage(static fn() => v::not(v::attribute('foo', v::trueVal(), true))->assert($object));
exceptionMessage(static fn() => v::attribute('foo', v::falseVal(), false)->assert($object));
exceptionMessage(static fn() => v::not(v::attribute('foo', v::trueVal(), false))->assert($object));
// phpcs:disable Generic.Files.LineLength.TooLong
?>
--EXPECTF--

Deprecated: The attribute() rule has been deprecated and will be removed in the next major version. Use propertyExists() instead. %s
baz must be present

Deprecated: The attribute() rule has been deprecated and will be removed in the next major version. Use propertyExists() instead. %s
foo must not be present

Deprecated: The attribute() rule has been deprecated and will be removed in the next major version. Use property() instead. %s
foo must evaluate to `false`

Deprecated: The attribute() rule has been deprecated and will be removed in the next major version. Use property() instead. %s
foo must not evaluate to `true`

Deprecated: The attribute() rule has been deprecated and will be removed in the next major version. Use property() without it. %s
foo must evaluate to `false`

Deprecated: The attribute() rule has been deprecated and will be removed in the next major version. Use property() without it. %s
foo must not evaluate to `true`

Deprecated: The attribute() rule has been deprecated and will be removed in the next major version. Use propertyOptional() instead. %s
foo must evaluate to `false`

Deprecated: The attribute() rule has been deprecated and will be removed in the next major version. Use propertyOptional() instead. %s
foo must not evaluate to `true`
