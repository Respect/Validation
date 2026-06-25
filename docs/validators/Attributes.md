<!--
SPDX-License-Identifier: MIT
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
-->

# Attributes

- `Attributes()`
- `Attributes(Resolver $resolver)`

Validates the PHP attributes defined in the properties of the input.

Example of object:

```php
use Respect\Validation\Validators as Validator;

#[Validator\AnyOf(
    new Validator\Property('email', new Validator\Not(new Validator\Undef())),
    new Validator\Property('phone', new Validator\Not(new Validator\Undef())),
)]
final class Person
{
    public function __construct(
        #[Validator\Not(new Validator\Undef())]
        public string $name,
        #[Validator\Date('Y-m-d')]
        public string $birthdate,
        #[Validator\Email]
        public ?string $email = null,
        #[Validator\Phone]
        public ?string $phone = null,
    ) {
    }
}
```

Here is how you can validate the attributes of the object:

```php
v::attributes()->assert(new Person('John Doe', '2020-06-23', 'john.doe@gmail.com'));
// Validation passes successfully

v::attributes()->assert(new Person('John Doe', '2020-06-23', 'john.doe@gmail.com', '+12024561111'));
// Validation passes successfully

v::attributes()->assert(new Person('', '2020-06-23', 'john.doe@gmail.com', '+12024561111'));
// → `.name` must be defined

v::attributes()->assert(new Person('John Doe', 'not a date', 'john.doe@gmail.com', '+12024561111'));
// → `.birthdate` must be a date in the "2005-12-30" format

v::attributes()->assert(new Person('John Doe', '2020-06-23', 'not an email', '+12024561111'));
// → `.email` must be an email address or must be null

v::attributes()->assert(new Person('John Doe', '2020-06-23', 'john.doe@gmail.com', 'not a phone number'));
// → `.phone` must be a phone number or must be null

v::attributes()->assert(new Person('John Doe', '2020-06-23'));
// → - `Person { +$name="John Doe" +$birthdate="2020-06-23" +$email=null +$phone=null }` must pass at least one of the rules
// →   - `.email` must be defined
// →   - `.phone` must be defined

v::attributes()->assert(new Person('', 'not a date', 'not an email', 'not a phone number'));
// → - `Person { +$name="" +$birthdate="not a date" +$email="not an email" +$phone="not a phone number" }` must pass the rules
// →   - `.name` must be defined
// →   - `.birthdate` must be a date in the "2005-12-30" format
// →   - `.email` must be an email address or must be null
// →   - `.phone` must be a phone number or must be null
```

## Caveats

### Empty objects

If the object has no validator attributes on any of its properties or class, the validation will always pass.

### Nullable properties

When a property is nullable (e.g., `?string $email`), `Attributes` wraps the property's validator into [NullOr](NullOr.md), so `null` values are accepted automatically.

### Nested object validation

When a property's type is a class (named, union, or intersection type), `Attributes` recursively validates that object's own properties, so there is no need to explicitly add `#[Attributes]` on the property.

- **Named types** (`NestedAddress $address`): the nested object is validated directly.
- **Union types** (`string|NestedAddress $address`): the nested object is only validated if it passes an `Instance` check first, so string values in the union are safely skipped.
- **Intersection types** (`NestedWithAttributes&Nested $address`): the nested object is validated directly, since it must satisfy all types in the intersection.
- **Untyped properties** (no type declaration, or builtin types like `string`): are never recursively validated.
- **Array properties**: `Attributes` **does not** recursively validate objects inside arrays. To validate each element, use the `#[Each]` attribute on the property (e.g., `#[Each(new Attributes())]`).

### Circular references

When a nested object graph contains a cycle (e.g., `$a->next = $b`, `$b->next = $a`), `Attributes` detects the revisit and fails with the `TEMPLATE_CIRCULAR_REFERENCE` template. This prevents infinite recursion and stack overflow.

Note that circular reference detection only works for direct object references. If a cycle passes through an array (e.g., `$a->items = [$b]`, `$b->parent = $a`), `Attributes` cannot track the reference and the validation will recurse infinitely, causing a stack overflow.

## Templates

### `Attributes::TEMPLATE_CIRCULAR_REFERENCE`

|       Mode | Template                                          |
| ---------: | :------------------------------------------------ |
|  `default` | {{subject}} must not contain a circular reference |
| `inverted` | {{subject}} must contain a circular reference     |

## Categorization

- Objects
- Structures

## Changelog

| Version | Description |
| ------: | :---------- |
|   3.0.0 | Created     |

## See Also

- [Named](Named.md)
- [NullOr](NullOr.md)
- [ObjectType](ObjectType.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
- [Templated](Templated.md)
