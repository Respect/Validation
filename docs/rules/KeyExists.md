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

- To validate an array against a given rule if the key exists, use [KeyOptional](KeyOptional.md) instead.
- To validate an array against a given rule requiring the key to exist, use [Key](Key.md) instead.

## Templates

### `KeyExists::TEMPLATE_STANDARD`

| Mode       | Template                        |
| ---------- | ------------------------------- |
| `default`  | {{subject}} must be present     |
| `inverted` | {{subject}} must not be present |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Caveats

`KeyExists` defines the given `$key` as the path, and because it is a standalone rule without children, it's not possible to display a fully custom name with it.

When no custom name is set, the path is displayed as `{{name}}`. When a custom name is set, the validation engine prepends the path to the custom name:

```php
v::keyExists('foo')->assert([]);
// Message: `.foo` must be present

v::keyExists('foo')->setName('Custom name')->assert([]);
// Message: `.foo` (<- Custom name) must be present
```

If you want to display only a custom name while checking if a key exists, use [Key](Key.md) with [AlwaysValid](AlwaysValid.md):

```php
v::key('foo', v::alwaysValid()->setName('Custom name'))->assert([]);
// Message: Custom name must be present
```

## Categorization

- Arrays
- Structures

## Changelog

| Version | Description                |
| ------: | -------------------------- |
|   3.0.0 | Created from [Key](Key.md) |

---

See also:

- [AlwaysValid](AlwaysValid.md)
- [ArrayType](ArrayType.md)
- [ArrayVal](ArrayVal.md)
- [Each](Each.md)
- [Key](Key.md)
- [KeyOptional](KeyOptional.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
