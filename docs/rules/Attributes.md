# Attributes

- `Attributes()`

Validates the PHP attributes defined in the properties of the input.

Example of object:

```php
use Respect\Validation\Rules;

final class Person
{
    public function __construct(
        #[Rules\NotEmpty]
        public readonly string $name,
        #[Rules\Email]
        public readonly string $email,
        #[Rules\Date('Y-m-d')]
        #[Rules\DateTimeDiff('years', new Rules\LessThanOrEqual(25))]
        public readonly string $birthdate,
        #[Rules\Phone]
        public readonly ?string $phone
    ) {
    }
}
```

Here is how you can validate the attributes of the object:

```php
v::attributes()->assert(new Person('John Doe', 'john.doe@gmail.com', '2020-06-23'));
// No exception

v::attributes()->assert(new Person('John Doe', 'john.doe@gmail.com', '2020-06-23', '+31 20 624 1111'));
// No exception

v::attributes()->assert(new Person('', 'john.doe@gmail.com', '2020-06-23', '+1234567890'));
// Message: name must not be empty

v::attributes()->assert(new Person('John Doe', 'not an email', '2020-06-23', '+1234567890'));
// Message: email must be a valid email address

v::attributes()->assert(new Person('John Doe', 'john.doe@gmail.com', 'not a date', '+1234567890'));
// Message: birthdate must be a valid date in the format "2005-12-30"

v::attributes()->assert(new Person('John Doe', 'john.doe@gmail.com', '2020-06-23', 'not a phone number'));
// Message: phone must be a valid telephone number or must be null

v::attributes()->assert(new Person('', 'not an email', 'not a date', 'not a phone number'));
// Full message:
// - All the required rules must pass for `Person { +$name="" +$email="not an email" +$birthdate="not a date" +$phone="not a phone number" }`
//   - name must not be empty
//   - email must be a valid email address
//   - All the required rules must pass for birthdate
//     - birthdate must be a valid date in the format "2005-12-30"
//     - For comparison with now, birthdate must be a valid datetime
//   - phone must be a valid telephone number or must be null
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

- [NullOr](NullOr.md)
- [ObjectType](ObjectType.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
- [Templated](Templated.md)
