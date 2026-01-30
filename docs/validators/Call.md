<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Call

- `Call(callable $callable, Validator $validator)`

Validates the return of a [callable][] for a given input.

```php
v::call(str_split(...), v::arrayType()->lengthEquals(5))->assert('world');
// Validation passes successfully
```

Consider the following variable:

```php
$url = 'http://www.google.com/search?q=respect.github.com';
```

To validate every part of this URL we could use the native `parse_url`
function to break its parts:

```php
$parts = parse_url($url);
```

This function returns an array containing `scheme`, `host`, `path` and `query`.
We can validate them this way:

```php
v::arrayVal()
    ->key('scheme', v::startsWith('http'))
    ->key('host', v::domain())
    ->key('path', v::stringType())
    ->key('query', v::notBlank());
```

Using `v::call()` you can do this in a single chain:

```php
v::call(
    'parse_url',
     v::arrayVal()
        ->key('scheme', v::startsWith('http'))
        ->key('host',   v::domain())
        ->key('path',   v::stringType())
        ->key('query',  v::notBlank())
)->assert($url);
// Validation passes successfully
```

Call does not handle possible errors (type mismatches). If you need to
ensure that your callback is of a certain type, use [Circuit](Circuit.md) or 
handle it using a closure:

```php
v::call('strtolower', v::equals('ABC'))->assert(123);
// 𝙭 strtolower(): Argument #1 ($string) must be of type string, int given

v::circuit(v::stringType(), v::call('strtolower', v::equals('abc')))->assert(123);
// → 123 must be a string

v::circuit(v::stringType(), v::call('strtolower', v::equals('abc')))->assert('ABC');
// Validation passes successfully
```

## Categorization

- Callables
- Nesting
- Transformations

## Changelog

| Version | Description                   |
| ------: | :---------------------------- |
|   3.0.0 | No longer sets error handlers |
|   0.3.9 | Created                       |

## See Also

- [Callback](Callback.md)
- [Dynamic](Dynamic.md)
- [Each](Each.md)
- [Sorted](Sorted.md)
