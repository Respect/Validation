# Length

- `Length(Validator $validator)`

Validates the length of the given input against a given validator.

```php
v::length(v::between(1, 5))->isValid('abc'); // true

v::length(v::greaterThan(5))->isValid('abcdef'); // true

v::length(v::lessThan(5))->isValid('abc'); // true
```

This validator can be used to validate the length of strings, arrays, and objects that implement the `Countable` interface.

```php
v::length(v::greaterThanOrEqual(3))->isValid([1, 2, 3]); // true

v::length(v::equals(0))->isValid(new SplPriorityQueue()); // true
```

## Templates

### `Length::TEMPLATE_STANDARD`

Used when it's possible to get the length of the input.

| Mode       | Template      |
| ---------- | ------------- |
| `default`  | The length of |
| `inverted` | The length of |

This template serve as message prefixes.:

```php
v::length(v::equals(3))->assert('tulip');
// Message: The length of "tulip" must be equal to 3

v::not(v::length(v::equals(4)))->assert('rose');
// Message: The length of "rose" must not be equal to 4
```

### `Length::TEMPLATE_WRONG_TYPE`

Used when it's impossible to get the length of the input.

| Mode       | Template                                              |
| ---------- | ----------------------------------------------------- |
| `default`  | {{subject}} must be a countable value or a string     |
| `inverted` | {{subject}} must not be a countable value or a string |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Comparisons
- Transformations

## Changelog

| Version | Description             |
| ------: | ----------------------- |
|   3.0.0 | Became a transformation |
|   0.3.9 | Created                 |

---

See also:

- [All](All.md)
- [Between](Between.md)
- [BetweenExclusive](BetweenExclusive.md)
- [Each](Each.md)
- [GreaterThan](GreaterThan.md)
- [GreaterThanOrEqual](GreaterThanOrEqual.md)
- [LessThan](LessThan.md)
- [LessThanOrEqual](LessThanOrEqual.md)
- [Max](Max.md)
- [Min](Min.md)
