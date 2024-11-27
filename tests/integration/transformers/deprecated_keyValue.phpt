--FILE--
<?php

declare(strict_types=1);

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::keyValue('foo', 'equals', 'bar')->check(['bar' => 42]));
exceptionMessage(static fn() => v::keyValue('foo', 'equals', 'bar')->check(['foo' => 42]));
exceptionMessage(static fn() => v::keyValue('foo', 'json', 'bar')->check(['foo' => 42, 'bar' => 43]));
exceptionMessage(static fn() => v::keyValue('foo', 'equals', 'bar')->check(['foo' => 1, 'bar' => 2]));
exceptionMessage(static fn() => v::not(v::keyValue('foo', 'equals', 'bar'))->check(['foo' => 1, 'bar' => 1]));
exceptionFullMessage(static fn() => v::keyValue('foo', 'equals', 'bar')->assert(['bar' => 42]));
exceptionFullMessage(static fn() => v::keyValue('foo', 'equals', 'bar')->assert(['foo' => 42]));
exceptionFullMessage(static fn() => v::keyValue('foo', 'json', 'bar')->assert(['foo' => 42, 'bar' => 43]));
exceptionFullMessage(static fn() => v::keyValue('foo', 'equals', 'bar')->assert(['foo' => 1, 'bar' => 2]));
exceptionFullMessage(static fn() => v::not(v::keyValue('foo', 'equals', 'bar'))->assert(['foo' => 1, 'bar' => 1]));
// phpcs:disable Generic.Files.LineLength.TooLong
?>
--EXPECTF--

Deprecated: The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead. in %s
foo must be present

Deprecated: The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead. in %s
bar must be present

Deprecated: The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead. in %s
bar must be valid to validate foo

Deprecated: The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead. in %s
foo must equal 2

Deprecated: The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead. in %s
foo must not equal 1

Deprecated: The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead. in %s
- foo must be present

Deprecated: The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead. in %s
- bar must be present

Deprecated: The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead. in %s
- bar must be valid to validate foo

Deprecated: The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead. in %s
- foo must equal 2

Deprecated: The keyValue() rule has been deprecated and will be removed in the next major version. Use nested lazy() instead. in %s
- foo must not equal 1
