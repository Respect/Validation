# ContainsAny

- `ContainsAny(array $needles)`
- `ContainsAny(array $needles, bool $identical)`

Validates if the input contains at least one of defined values

For strings (comparing is case insensitive):

```php
v::containsAny(['lorem', 'dolor'])->assert('lorem ipsum');
// Validation passes successfully
```

For arrays (comparing is case sensitive to respect "contains" behavior):

```php
v::containsAny(['lorem', 'dolor'])->assert(['ipsum', 'lorem']);
// Validation passes successfully
```

A second parameter may be passed for identical comparison instead
of equal comparison for arrays.

Message template for this validator includes `{{needles}}`.

## Templates

### `ContainsAny::TEMPLATE_STANDARD`

| Mode       | Template                                                     |
| ---------- | ------------------------------------------------------------ |
| `default`  | {{subject}} must contain at least one value from {{needles}} |
| `inverted` | {{subject}} must not contain any value from {{needles}}      |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |
| `needles`   |                                                                  |

## Categorization

- Arrays
- Strings

## Changelog

| Version | Description |
| ------: | ----------- |
|   2.0.0 | Created     |

---

See also:

- [AnyOf](AnyOf.md)
- [Contains](Contains.md)
- [Equivalent](Equivalent.md)
- [In](In.md)
