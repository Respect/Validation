# Each

- `Each(Validatable $rule)`

Validates whether each value in the input is valid according to another rule.

```php
$releaseDates = [
    'validation' => '2010-01-01',
    'template'   => '2011-01-01',
    'relational' => '2011-02-05',
];

v::each(v::dateTime())->validate($releaseDates); // true
```

You can also validate array keys combining this rule with [Call](Call.md):

```php
v::call('array_keys', v::each(v::stringType()))->validate($releaseDates); // true
```

This rule will not validate values that are not iterable, to have a more detailed
error message, add [IterableType](IterableType.md) to your chain, for example.

If the input is empty this rule will consider the value as valid, you use
[NotEmpty](NotEmpty.md) if convenient:

```php
v::each(v::dateTime())->validate([]); // true
v::notEmpty()->each(v::dateTime())->validate([]); // false
```

## Changelog

Version | Description
--------|-------------
  2.0.0 | Remove support for key validation
  0.3.9 | Created

***
See also:

- [ArrayVal](ArrayVal.md)
- [Call](Call.md)
- [IterableType](IterableType.md)
- [Key](Key.md)
