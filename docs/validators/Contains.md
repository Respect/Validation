# Contains

- `Contains(mixed $containsValue)`
- `Contains(mixed $containsValue, bool $identical)`

Validates if the input contains some value.

For strings:

```php
v::contains('ipsum')->isValid('lorem ipsum'); // true
```

For arrays:

```php
v::contains('ipsum')->isValid(['ipsum', 'lorem']); // true
```

A second parameter may be passed for identical comparison instead
of equal comparison.

Message template for this validator includes `{{containsValue}}`.

## Templates

### `Contains::TEMPLATE_STANDARD`

| Mode       | Template                                       |
| ---------- | ---------------------------------------------- |
| `default`  | {{subject}} must contain {{containsValue}}     |
| `inverted` | {{subject}} must not contain {{containsValue}} |

## Template placeholders

| Placeholder     | Description                                                      |
| --------------- | ---------------------------------------------------------------- |
| `containsValue` |                                                                  |
| `subject`       | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays
- Strings

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.3.9 | Created     |

---

See also:

- [ContainsAny](ContainsAny.md)
- [EndsWith](EndsWith.md)
- [Equals](Equals.md)
- [Equivalent](Equivalent.md)
- [Identical](Identical.md)
- [In](In.md)
- [Regex](Regex.md)
- [StartsWith](StartsWith.md)
- [Unique](Unique.md)
