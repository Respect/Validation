# Templated

- `Templated(string $template, Rule $rule)`
- `Templated(string $template, Rule $rule, array<string, mixed> $parameters)`

Defines a rule with a custom message template.

```php
v::templated('You must provide a valid email to signup', v::email())->assert('not an email');
// Message: You must provide a valid email to signup

v::templated(
    'The author of the page {{title}} is empty, please fill it up.',
    v::notBlank(),
    ['title' => 'Feature Guide']
)->assert('');
// Message: The author of the page "Feature Guide" is empty, please fill it up.
```

This rule can be also useful when you're using [Attributes](Attributes.md) and want a custom template for a specific property.

## Templates

This rule does not have any templates, as you must define the templates yourself.

## Template placeholders

| Placeholder | Description                                                      |
| ----------- | ---------------------------------------------------------------- |
| `subject`   | The validated input or the custom validator name (if specified). |

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
- [Named](Named.md)
- [Not](Not.md)
