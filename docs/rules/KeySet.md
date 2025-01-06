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

It is not possible to negate `keySet()` rules with `not()`.

The keys' order is not considered in the validation.

## Categorization

- Arrays
- Nesting
- Structures

## Changelog

Version | Description
--------|-------------
  2.3.0 | KeySet is NonNegatable, fixed message with extra keys
  1.0.0 | Created

***
See also:

- [ArrayVal](ArrayVal.md)
- [Key](Key.md)
- [KeyValue](KeyValue.md)
