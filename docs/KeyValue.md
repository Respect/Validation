# KeyValue

- `keyValue(string $comparedKey, string $ruleName, string $baseKey)`

Performs validation of `$comparedKey` using the rule named on `$ruleName` with
`$baseKey` as base.

Sometimes, when validating arrays, the validation of a key value depends on
another key value and that may cause some ugly code since you need the input
before the validation, making some checking manually:

```php
v::key('password')->check($_POST);
v::key('password_confirmation', v::equals($_POST['password']))->check($_POST);
```

The problem with the above code is because you do not know if `password` is a
valid key, so you must check it manually before performing the validation on
`password_confirmation`.

The `keyValue()` rule makes this job easier by creating a rule named on
`$ruleName` passing `$baseKey` as the first argument of this rule, see an example:

```php
v::keyValue('password_confirmation', 'equals', 'password')->validate($_POST);
```

The above code will result on `true` if _`$_POST['password_confirmation']` is
[equals](Equals.md) to `$_POST['password']`_, it's the same of:

See another example:

```php
v::keyValue('state', 'subdivisionCode', 'country')->validate($_POST);
```

The above code will result on `true` if _`$_POST['state']` is a
[subdivision code](SubdivisionCode.md) of `$_POST['country']`_:

This rule will invalidate the input if `$comparedKey` or `$baseKey` don't exist,
or if the rule named on `$ruleName` could not be created (or don't exist).

When using `assert()` or `check()` methods and the rule do not pass, it overwrites
all values in the validation exceptions with `$baseKey` and `$comparedKey`.

```php
v::keyValue('password_confirmation', 'equals', 'password')->check($input);
```

The above code may generate the message:

```
password_confirmation must be equals "password"
```

## Changelog

Version | Description
--------|-------------
  1.0.0 | Created

***
See also:

- [Key](Key.md)
- [KeyNested](KeyNested.md)
- [KeySet](KeySet.md)

