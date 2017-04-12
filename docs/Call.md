# Call

- `Call(callable $callable, Rule $rule)`

This is a very low level validator. It calls a function, method or closure
for the input and then validates it. Consider the following variable:

```php
$url = 'http://www.google.com/search?q=respect.github.com'
```

To validate every part of this URL we could use the native `parse_url`
function to break its parts:

```php
$parts = parse_url($url);
```

This function returns an array containing `scheme`, `host`, `path` and `query`.
We can validate them this way:

```php
v::arrayVal()->key('scheme', v::startsWith('http'))
        ->key('host',   v::domain())
        ->key('path',   v::stringType())
        ->key('query',  v::notEmpty());
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

It is possible to call methods and closures as the first parameter:

```php
v::call([$myObj, 'methodName'], v::intVal())->validate($myInput);
v::call(function($input) {}, v::intVal())->validate($myInput);
```

## Changelog

Version | Description
--------|-------------
  0.3.9 | Created

***
See also:

- [Callback](Callback.md)
