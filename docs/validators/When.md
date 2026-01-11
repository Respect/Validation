# When

- `When(Validator $if, Validator $then)`
- `When(Validator $if, Validator $then, Validator $else)`

A ternary validator that accepts three parameters.

When the `$if` validates, returns validation for `$then`.
When the `$if` doesn't validate, returns validation for `$else`, if defined.

```php
v::when(v::intVal(), v::positive(), v::notBlank())->isValid(1); // true
v::when(v::intVal(), v::positive(), v::notBlank())->isValid('non-blank string'); // true

v::when(v::intVal(), v::positive(), v::notBlank())->isValid(-1); // false
v::when(v::intVal(), v::positive(), v::notBlank())->isValid(''); // false
```

In the sample above, if `$input` is an integer, then it must be positive.
If `$input` is not an integer, then it must not be blank.
When `$else` is not defined use [AlwaysInvalid](AlwaysInvalid.md)

## Templates

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Conditions
- Nesting

## Changelog

| Version | Description                         |
| ------: | ----------------------------------- |
|   0.8.0 | Allow to use validator without else |
|   0.3.9 | Created                             |

---

See also:

- [AlwaysInvalid](AlwaysInvalid.md)
- [Circuit](Circuit.md)
- [LogicAnd](LogicAnd.md)
- [LogicNor](LogicNor.md)
- [LogicOr](LogicOr.md)
- [OneOf](OneOf.md)
