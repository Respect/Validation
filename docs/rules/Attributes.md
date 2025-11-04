# Attributes

- `Attributes()`

Validates the PHP attributes defined in the properties of the input.

You can validate the attributes of an object that has PHP attributes defined on its properties:

```php
// For documentation examples, we show how the validation would work:
// v::attributes()->assert($objectWithAttributes); // passes if all attributes are valid
// throws ValidationException with message: `.property` must not be empty
// v::attributes()->assert($objectWithInvalidAttributes);
```

## Caveats

* If the object has no attributes, the validation will always pass.
* When the property is nullable, this rule will wrap the rule on the property into [NullOr](NullOr.md) rule.
* This rule has no templates because it uses the templates of the rules that are applied to the properties.

## Categorization

- Objects
- Structures

## Changelog

| Version | Description |
|--------:|-------------|
|   3.0.0 | Created     |

***
See also:

- [Named](Named.md)
- [NullOr](NullOr.md)
- [ObjectType](ObjectType.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
- [Templated](Templated.md)
