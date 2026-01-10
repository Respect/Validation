# In

- `In(mixed $haystack)`
- `In(mixed $haystack, bool $identical)`

Validates if the input is contained in a specific haystack.

For strings:

```php
v::in('lorem ipsum')->assert('ipsum');
// Validation passes successfully
```

For arrays:

```php
v::in(['lorem', 'ipsum'])->assert('lorem');
// Validation passes successfully
```

A second parameter may be passed for identical comparison instead
of equal comparison.

Message template for this validator includes `{{haystack}}`.

## Templates

### `In::TEMPLATE_STANDARD`

| Mode       | Template                                |
| ---------- | --------------------------------------- |
| `default`  | {{subject}} must be in {{haystack}}     |
| `inverted` | {{subject}} must not be in {{haystack}} |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `haystack`  |                                                                  |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Arrays
- Comparisons
- Strings

## Changelog

| Version | Description |
| ------: | ----------- |
|   0.3.9 | Created     |

---

See also:

- [Contains](Contains.md)
- [ContainsAny](ContainsAny.md)
- [EndsWith](EndsWith.md)
- [Roman](Roman.md)
- [StartsWith](StartsWith.md)
