# KeySet

- `v::keySet(Key $rule...)`

Validates a keys in a defined structure.

```php
$dict = array('foo' => 42);

v::keySet(
    v::key('foo', v::int())
)->validate($dict); //true
```

Extra keys are not allowed:
```php
$dict = array('foo' => 42, 'bar' => 'String');

v::keySet(
    v::key('foo', v::int())
)->validate($dict); //false
```

Missing required keys are not allowed:
```php
$dict = array('foo' => 42, 'bar' => 'String');

v::keySet(
    v::key('foo', v::int()),
    v::key('bar', v::string()),
    v::key('baz', v::bool())
)->validate($dict); //false
```

Missing non-required keys are allowed:
```php
$dict = array('foo' => 42, 'bar' => 'String');

v::keySet(
    v::key('foo', v::int()),
    v::key('bar', v::string()),
    v::key('baz', v::bool(), false)
)->validate($dict); //true
```

The keys' order is not considered in the validation.

See also:

  * [Key](Key.md)
