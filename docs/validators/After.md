<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# After

- `After(callable $callable, Validator $validator)`

Validates the input after applying a [callable][] to it.

```php
v::after(str_split(...), v::arrayType()->lengthEquals(5))->assert('world');
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
v::after(
    'parse_url',
     v::arrayVal()
        ->key('scheme', v::startsWith('http'))
        ->key('host',   v::domain())
        ->key('path',   v::stringType())
        ->key('query',  v::notBlank())
)->assert($url);
// Validation passes successfully
```

`After` does not handle possible errors (type mismatches). If you need to
ensure that your callback is of a certain type, use [ShortCircuit](ShortCircuit.md) or 
handle it using a closure:

```php
v::after('strtolower', v::equals('ABC'))->assert(123);
// 𝙭 strtolower(): Argument #1 ($string) must be of type string, int given

v::shortCircuit(v::stringType(), v::after('strtolower', v::equals('abc')))->assert(123);
// → 123 must be a string

v::shortCircuit(v::stringType(), v::after('strtolower', v::equals('abc')))->assert('ABC');
// Validation passes successfully
```

## Categorization

- Callables
- Nesting
- Transformations

## Changelog

| Version | Description                                              |
| ------: | :------------------------------------------------------- |
|   3.0.0 | No longer sets error handlers and got renamed to `After` |
|   2.0.0 | Sets error handlers                                      |
|   0.3.9 | Created as `Call`                                        |

## See Also

- [Each](Each.md)
- [Factory](Factory.md)
- [Satisfies](Satisfies.md)
- [Sorted](Sorted.md)
