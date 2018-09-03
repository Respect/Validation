# KeySet

- `KeySet(Key ...$rule)`

Validates a keys in a defined structure.

```php
$dict = ['foo' => 42];

v::keySet(
    v::key('foo', v::intVal())
)->isValid($dict); // true
```

Extra keys are not allowed:
```php
$dict = ['foo' => 42, 'bar' => 'String'];

v::keySet(
    v::key('foo', v::intVal())
)->isValid($dict); // false
```

Missing required keys are not allowed:
```php
$dict = ['foo' => 42, 'bar' => 'String'];

v::keySet(
    v::key('foo', v::intVal()),
    v::key('bar', v::stringType()),
    v::key('baz', v::boolType())
)->isValid($dict); // false
```

Missing non-required keys are allowed:
```php
$dict = ['foo' => 42, 'bar' => 'String'];

v::keySet(
    v::key('foo', v::intVal()),
    v::key('bar', v::stringType()),
    v::key('baz', v::boolType(), false)
)->isValid($dict); // true
```

The keys' order is not considered in the validation.

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [Key](Key.md)
