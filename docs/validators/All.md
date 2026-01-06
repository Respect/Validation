# All

- `All(Validator $validator)`

Validates all items of the input against a given validator.

```php
v::all(v::intType())->assert([1, 2, 3]);
// Validation passes successfully

v::all(v::intType())->assert([1, 2, '3']);
// → Every item in `[1, 2, "3"]` must be an integer
```

This validator is similar to [Each](Each.md), but as opposed to the former, it displays a single message when asserting an input.

## Note

This validator uses [Length](Length.md) with [GreaterThan][GreaterThan.md] internally. If an input has no items, the validation will fail.

## Templates

### `All::TEMPLATE_STANDARD`

| Mode       | Template      |
| ---------- | ------------- |
| `default`  | Every item in |
| `inverted` | Every item in |

This template serve as message prefixes.:

```php
v::all(v::floatType())->assert([1.5, 2]);
// → Every item in `[1.5, 2]` must be float

v::not(v::all(v::intType()))->assert([1, 2, -3]);
// → Every item in `[1, 2, -3]` must not be an integer
```

## Categorization

- Comparisons
- Transformations

## Changelog

| Version | Description |
| ------: | ----------- |
|   3.0.0 | Created     |

---

See also:

- [Each](Each.md)
- [Length](Length.md)
- [Max](Max.md)
- [Min](Min.md)
