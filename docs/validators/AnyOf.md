# AnyOf

- `AnyOf(Validator $validator1, Validator $validator2)`
- `AnyOf(Validator $validator1, Validator $validator2, Validator ...$validators)`

This is a group validator that acts as an OR operator.

```php
v::anyOf(v::intVal(), v::floatVal())->isValid(15.5); // true
```

In the sample above, `IntVal()` doesn't validates, but `FloatVal()` validates,
so `AnyOf()` returns true.

`AnyOf()` returns true if at least one inner validator passes.

## Templates

### `AnyOf::TEMPLATE_STANDARD`

| Mode       | Template                                        |
| ---------- | ----------------------------------------------- |
| `default`  | {{subject}} must pass at least one of the rules |
| `inverted` | {{subject}} must pass at least one of the rules |

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

## Categorization

- Composite
- Nesting

## Changelog

| Version | Description                                   |
| ------: | --------------------------------------------- |
|   3.0.0 | Require at least two validators to be defined |
|   2.0.0 | Created                                       |

---

See also:

- [AllOf](AllOf.md)
- [Circuit](Circuit.md)
- [ContainsAny](ContainsAny.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [When](When.md)
