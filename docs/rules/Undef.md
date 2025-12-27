# Undef

- `Undef()`

Validates if the given input is undefined. By _undefined_ we consider `null` or an empty string (`''`).

```php
v::undef()->isValid(''); // true
v::undef()->isValid(null); // true
```

Other values similar to _undefined_ values are considered _defined_:

```php
v::undef()->isValid([]); // false
v::undef()->isValid(' '); // false
v::undef()->isValid(0); // false
v::undef()->isValid('0'); // false
v::undef()->isValid('0.0'); // false
v::undef()->isValid(false); // false
v::undef()->isValid(['']); // false
v::undef()->isValid([' ']); // false
v::undef()->isValid([0]); // false
v::undef()->isValid(['0']); // false
v::undef()->isValid([false]); // false
v::undef()->isValid([[''], [0]]); // false
v::undef()->isValid(new stdClass()); // false
```

## Templates

### `Undef::TEMPLATE_STANDARD`

| Mode       | Template                      |
| ---------- | ----------------------------- |
| `default`  | {{subject}} must be undefined |
| `inverted` | {{subject}} must be defined   |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Miscellaneous

## Changelog

| Version | Description                                 |
| ------: | ------------------------------------------- |
|   3.0.0 | Renamed to `Undef` and changed the behavior |
|   1.0.0 | Created as `NotOptional`                    |

---

See also:

- [Blank](Blank.md)
- [NotEmpty](NotEmpty.md)
- [NoWhitespace](NoWhitespace.md)
- [NullType](NullType.md)
- [Number](Number.md)
- [UndefOr](UndefOr.md)
