# KeySet

- `v::keySet(Key $rule...)`

Validates a keys in a defined structure.

```php
$dict = ['foo' => 42];

v::keySet(
    v::key('foo', v::intVal())
)->validate($dict); // true
```

Extra keys are not allowed:
```php
$dict = ['foo' => 42, 'bar' => 'String'];

v::keySet(
    v::key('foo', v::intVal())
)->validate($dict); // false
```

Missing required keys are not allowed:
```php
$dict = ['foo' => 42, 'bar' => 'String'];

v::keySet(
    v::key('foo', v::intVal()),
    v::key('bar', v::stringType()),
    v::key('baz', v::boolType())
)->validate($dict); // false
```

Missing non-required keys are allowed:
```php
$dict = ['foo' => 42, 'bar' => 'String'];

v::keySet(
    v::key('foo', v::intVal()),
    v::key('bar', v::stringType()),
    v::key('baz', v::boolType(), false)
)->validate($dict); // true
```

The keys' order is not considered in the validation.

***
See also:

  * [Key](Key.md)
