# KeyExists

- `KeyExists(int|string $key)`

Validates if the given key exists in an array.

```php
v::keyExists('name')->validate(['name' => 'The Respect Panda']); // true
v::keyExists('name')->validate(['email' => 'therespectpanda@gmail.com']); // false

v::keyExists(0)->validate(['a', 'b', 'c']); // true
v::keyExists(4)->validate(['a', 'b', 'c']); // false

v::keyExists('username')->validate(new ArrayObject(['username' => 'therespectpanda'])); // true
v::keyExists(5)->validate(new ArrayObject(['a', 'b', 'c'])); // false
```

## Notes

* To validate an array against a given rule if the key exists, use [KeyOptional](KeyOptional.md) instead.
* To validate an array against a given rule requiring the key to exist, use [Key](Key.md) instead.

## Categorization

- Arrays
- Structures

## Changelog

| Version | Description                |
| ------: |----------------------------|
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
