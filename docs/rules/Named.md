# Named

- `Named(string $name, Rule $rule)`

Validates the input with the given rule, and uses the custom name in the error message.

```php
v::named('Your email', v::email())->assert('not an email');
// Message: Your email must be a valid email address
```

Here's an example of a similar code, but without using the `Named` rule:

```php
v::email()->assert('not an email');
// Message: "not an email" must be a valid email address
```

The `Named` rule can be also useful when you're using [Attributes](Attributes.md) and want a custom name for a specific property.

## Templates

This rule does not have any templates, as it will use the template of the given rule.

## Template placeholders

| Placeholder | Description                           |
| ----------- | ------------------------------------- |
| `subject`   | The value that you define as `$name`. |

## Categorization

- Core
- Structures
- Miscellaneous

## Changelog

| Version | Description |
| ------: | ----------- |
|   3.0.0 | Created     |

---

See also:

- [Attributes](Attributes.md)
- [Not](Not.md)
- [Templated](Templated.md)
