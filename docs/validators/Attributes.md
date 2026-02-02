<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Attributes

- `Attributes()`

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

- If the object has no attributes, the validation will always pass.
- When the property is nullable, this validator will wrap the validator on the property into [NullOr](NullOr.md) validator.
- This validator has no templates because it uses the templates of the validators that are applied to the properties.

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
