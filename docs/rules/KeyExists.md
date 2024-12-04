# KeyExists

- `KeyExists(int|string $key)`

Validates if the given key exists in an array.

```php
v::keyExists('name')->isValid(['name' => 'The Respect Panda']); // true
v::keyExists('name')->isValid(['email' => 'therespectpanda@gmail.com']); // false

v::keyExists(0)->isValid(['a', 'b', 'c']); // true
v::keyExists(4)->isValid(['a', 'b', 'c']); // false

v::keyExists('username')->isValid(new ArrayObject(['username' => 'therespectpanda'])); // true
v::keyExists(5)->isValid(new ArrayObject(['a', 'b', 'c'])); // false
```

## Notes

* To validate an array against a given rule if the key exists, use [KeyOptional](KeyOptional.md) instead.
* To validate an array against a given rule requiring the key to exist, use [Key](Key.md) instead.

## Templates

`KeyExists::TEMPLATE_STANDARD`

| Mode       | Template                     |
|------------|------------------------------|
| `default`  | {{name}} must be present     |
| `inverted` | {{name}} must not be present |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays
- Structures

## Changelog

| Version | Description                |
|--------:|----------------------------|
|   3.0.0 | Created from [Key](Key.md) |

***
See also:

- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Each](Each.md)
- [Key](Key.md)
- [KeyOptional](KeyOptional.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
