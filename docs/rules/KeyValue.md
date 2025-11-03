# KeyValue

!!! warning "Removed in v3.0"
    This rule was removed. Use [Key](./Key.md) with chaining instead.
    See [Migration Guide](../11-migration-from-2x.md#removed-rules) for migration path.

## Replacement

```php
// v2.x
v::keyValue('password', 'password_confirmation')

// v3.0
v::key('password_confirmation', v::equals($input['password']))
```

## Description (v2.x)

Validates that the value of one key equals the value of another key in the same array.

## Examples (v2.x)

```php
$data = [
    'password' => 'mypassword',
    'password_confirmation' => 'mypassword'
];

v::keyValue('password', 'password_confirmation')->isValid($data); // true

$data['password_confirmation'] = 'different';
v::keyValue('password', 'password_confirmation')->isValid($data); // false
```

## Changelog

| Version | Description         |
|--------:|---------------------|
|   3.0.0 | Removed             |
|   1.0.0 | Created             |

***
See also:

- [Key](Key.md)
- [Equals](Equals.md)
- [Consecutive](Consecutive.md) (also removed)