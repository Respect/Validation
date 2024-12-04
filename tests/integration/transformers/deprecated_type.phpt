--FILE--
<?php

require 'vendor/autoload.php';

exceptionMessage(static fn() => v::type('array')->assert(1));
exceptionMessage(static fn() => v::type('bool')->assert(1));
exceptionMessage(static fn() => v::type('boolean')->assert(1));
exceptionMessage(static fn() => v::type('callable')->assert(1));
exceptionMessage(static fn() => v::type('double')->assert(1));
exceptionMessage(static fn() => v::type('float')->assert(1));
exceptionMessage(static fn() => v::type('int')->assert('1'));
exceptionMessage(static fn() => v::type('integer')->assert('1'));
exceptionMessage(static fn() => v::type('null')->assert(1));
exceptionMessage(static fn() => v::type('object')->assert(1));
exceptionMessage(static fn() => v::type('resource')->assert(1));
exceptionMessage(static fn() => v::type('string')->assert(1));
?>
--EXPECTF--

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use arrayType() instead. %s
1 must be an array

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use boolType() instead. %s
1 must be a boolean

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use boolType() instead. %s
1 must be a boolean

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use callableType() instead. %s
1 must be a callable

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use floatType() instead. %s
1 must be float

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use floatType() instead. %s
1 must be float

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use intType() instead. %s
"1" must be an integer

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use intType() instead. %s
"1" must be an integer

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use nullType() instead. %s
1 must be null

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use objectType() instead. %s
1 must be an object

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use resourceType() instead. %s
1 must be a resource

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use stringType() instead. %s
1 must be a string
