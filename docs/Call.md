# Call

- `Call(callable $callable, Rule $rule)`

Validates the return of a [callable][] for a given input.

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
    ->key('query', v::notEmpty());
```

Using `v::call()` you can do this in a single chain:

```php
v::call(
    'parse_url',
     v::arrayVal()->key('scheme', v::startsWith('http'))
        ->key('host',   v::domain())
        ->key('path',   v::stringType())
        ->key('query',  v::notEmpty())
)->validate($url);
```

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Callback](Callback.md)

- [callable]: http://php.net/callable
