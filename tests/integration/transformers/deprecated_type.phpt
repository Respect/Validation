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

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use arrayType() instead. in %s
1 must be of type array

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use boolType() instead. in %s
1 must be of type boolean

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use boolType() instead. in %s
1 must be of type boolean

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use callableType() instead. in %s
1 must be callable

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use floatType() instead. in %s
1 must be of type float

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use floatType() instead. in %s
1 must be of type float

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use intType() instead. in %s
"1" must be of type integer

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use intType() instead. in %s
"1" must be of type integer

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use nullType() instead. in %s
1 must be null

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use objectType() instead. in %s
1 must be of type object

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use resourceType() instead. in %s
1 must be a resource

Deprecated: The type() rule is deprecated and will be removed in the next major version. Use stringType() instead. in %s
1 must be of type string
