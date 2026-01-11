# LogicCond

- `LogicCond(Validator $if, Validator $then)`
- `LogicCond(Validator $if, Validator $then, Validator $else)`

A conditional validator that applies logic based on the validation results.

If the `$if` validator passes, it applies the `$then` validator. If the `$if` validator fails, it applies the `$else` validator (if provided); otherwise, validation fails.

```php
v::logicCond(v::intVal(), v::positive(), v::notBlank())->isValid(1); // true
v::logicCond(v::intVal(), v::positive(), v::notBlank())->isValid('non-blank string'); // true

v::logicCond(v::intVal(), v::positive(), v::notBlank())->isValid(-1); // false
v::logicCond(v::intVal(), v::positive(), v::notBlank())->isValid(''); // false
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
- Logical
- Nesting

## Changelog

| Version | Description                         |
| ------: | ----------------------------------- |
|   3.0.0 | Renamed to `LogicCond`              |
|   0.8.0 | Allow to use validator without else |
|   0.3.9 | Created as `When`                   |

---

See also:

- [AlwaysInvalid](AlwaysInvalid.md)
- [Circuit](Circuit.md)
- [LogicAnd](LogicAnd.md)
- [LogicNor](LogicNor.md)
- [LogicOr](LogicOr.md)
- [LogicXor](LogicXor.md)
