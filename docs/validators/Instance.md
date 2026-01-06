# Instance

- `Instance(string $instanceName)`

Validates if the input is an instance of the given class or interface.

```php
v::instance('DateTime')->assert(new DateTime);
// Validation passes successfully

v::instance('Traversable')->assert(new ArrayObject);
// Validation passes successfully
```

Message template for this validator includes `{{instanceName}}`.

## Templates

### `Instance::TEMPLATE_STANDARD`

| Mode       | Template                                                    |
| ---------- | ----------------------------------------------------------- |
| `default`  | {{subject}} must be an instance of `{{class&#124;raw}}`     |
| `inverted` | {{subject}} must not be an instance of `{{class&#124;raw}}` |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `class`     |                                                                  |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Objects

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.3.9 | Created     |

---

See also:

- [Countable](Countable.md)
- [IterableType](IterableType.md)
- [IterableVal](IterableVal.md)
- [ObjectType](ObjectType.md)
- [Type](Type.md)
