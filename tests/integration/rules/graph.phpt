--CREDITS--
Danilo Correa <danilosilva87@gmail.com>
--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

use Respect\Validation\Exceptions\GraphException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

try {
    v::graph()->check("foo\nbar");
} catch (GraphException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::graph('foo')->check("foo\nbar");
} catch (GraphException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::graph())->check('foobar');
} catch (GraphException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::not(v::graph("\n"))->check("foo\nbar");
} catch (GraphException $exception) {
    echo $exception->getMessage() . PHP_EOL;
}

try {
    v::graph()->assert("foo\nbar");
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::graph('foo')->assert("foo\nbar");
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::graph())->assert('foobar');
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

try {
    v::not(v::graph("\n"))->assert("foo\nbar");
} catch (NestedValidationException $exception) {
    echo $exception->getFullMessage() . PHP_EOL;
}

?>
--EXPECT--
"foo\nbar" must contain only graphical characters
"foo\nbar" must contain only graphical characters and "foo"
"foobar" must not contain graphical characters
"foo\nbar" must not contain graphical characters or "\n"
- "foo\nbar" must contain only graphical characters
- "foo\nbar" must contain only graphical characters and "foo"
- "foobar" must not contain graphical characters
- "foo\nbar" must not contain graphical characters or "\n"
