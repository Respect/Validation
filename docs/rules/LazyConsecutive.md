# LazyConsecutive

- `LazyConsecutive(callable(mixed $input): Validatable ...$ruleCreators)`

This executes a series of callbacks that create rules. Those callbacks accept the input as an argument and must return
an instance of `Validatable`.

This is particularly useful when the creation of rules would rely on the input itself. A good example is validating
whether a `password_confirmation` field matches the `password` field when processing data from a form.

```php
v::key('password', v::notEmpty())->validate($_POST);
v::key('password_confirmation', v::equals($_POST['password'] ?? null))->validate($_POST);
```

The problem with the above code is that you do not know if the `password` is a valid key, so you must check it manually
before performing the validation on `password_confirmation`. Besides, it could make it harder to reuse the validator.

The `lazyConsecutive()` rule makes this job much simpler and more elegantly:

```php
v::lazyConsecutive(
    static fn() => v::key('password', v::stringType()->notEmpty()),
    static fn($input) => v::key('password_confirmation', v::equals($input['password'])),
)->validate($_POST);
```

The return of the above code will be `true` if `$_POST['password_confirmation']` [equals](Equals.md)
`$_POST['password']`. The `lazyConsecutive()` rule will only execute the second callable if the rule from the first
callable passes.

Another typical example is validating country and subdivision codes:

```php
v::lazyConsecutive(
    static fn() => v::key('countryCode', v::countryCode()),
    static fn($input) => v::key('subdivisionCode', v::subdivisionCode($input['countryCode'])),
)->validate($_POST);
```

The return of the above code will be `true` if `$_POST['subdivisionCode']` is a [subdivision code](SubdivisionCode.md)
of `$_POST['countryCode']`.

## Categorization

- Callables
- Composite
- Nesting

## Changelog

| Version | Description |
| ------: | ----------- |
|   3.0.0 | Created     |

***
See also:

- [AllOf](AllOf.md)
- [AnyOf](AnyOf.md)
- [Call](Call.md)
- [Equals](Equals.md)
- [NoneOf](NoneOf.md)
- [OneOf](OneOf.md)
- [SubdivisionCode](SubdivisionCode.md)
