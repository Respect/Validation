# Circuit

- `Circuit(Rule $rule1, Rule $rule2, Rule ...$rule)`

Validates the input against a series of rules until the first fails.

This rule can be handy for getting the least error messages possible from a chain.

This rule can be helpful in combinations with [Lazy](Lazy.md). An excellent example is when you want to validate a
country code and a subdivision code.

```php
v::circuit(
    v::key('countryCode', v::countryCode()),
    v::lazy(static fn($input) => v::key('subdivisionCode', v::subdivisionCode($input['countryCode']))),
)->isValid($_POST);
```

You need a valid country code to create a [SubdivisionCode](SubdivisionCode.md), so it makes sense only to validate the
subdivision code only if the country code is valid. In this case, you could also have used [When](When.md), but you
would then have to write `v::key('countryCode', v::countryCode())` twice in your chain.

## Templates

This rule does not have any templates, because it will always return the result of the first rule that fails. When all the validation rules pass, it will return the result of the last rule of the circuit.

## Categorization

- Composite
- Conditions
- Nesting

## Changelog

| Version | Description |
| ------: | ----------- |
|   3.0.0 | Created     |

---

See also:

- [AllOf](AllOf.md)
- [AnyOf](AnyOf.md)
- [Lazy](Lazy.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [SubdivisionCode](SubdivisionCode.md)
- [When](When.md)
