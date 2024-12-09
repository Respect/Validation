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
        public readonly string $birthdate,
        #[Rules\Phone]
        public readonly ?string $phone
    ) {
    }
}
```

Here is how you can validate the attributes of the object:

```php
v::attributes()->assert(new Person('John Doe', 'john.doe@gmail.com', '1912-06-23', '+1234567890'));
// No exception

v::attributes()->assert(new Person('John Doe', 'john.doe@gmail.com', '1912-06-23', null));
// No exception

v::attributes()->assert(new Person('', 'john.doe@gmail.com', '1912-06-23', '+1234567890'));
// Message: name must not be empty

v::attributes()->assert(new Person('John Doe', 'not an email', '1912-06-23', '+1234567890'));
// Message: email must be a valid email address

v::attributes()->assert(new Person('John Doe', 'john.doe@gmail.com', 'not a date', '+1234567890'));
// Message: birthdate must be a valid date in the format "2005-12-30"

v::attributes()->assert(new Person('John Doe', 'john.doe@gmail.com', '1912-06-23', 'not a phone number'));
// Message: phone must be a valid telephone number or must be null

v::attributes()->assert(new Person('', 'not an email', 'not a date', 'not a phone number'));
// Full message:
// - The properties of `Person { +$name="" +$email="not an email" +$birthdate="not a date" +$phone="not a phone number" }` must be valid
//   - name must not be empty
//   - email must be a valid email address
//   - birthdate must be a valid date in the format "2005-12-30"
//   - phone must be a valid telephone number or must be null
```

## Templates

### `Attributes::TEMPLATE_STANDARD`

| Mode       | Template                                     |
|------------|----------------------------------------------|
| `default`  | The properties of {{name}} must be valid     |
| `inverted` | The properties of {{name}} must not be valid |

## Template placeholders

| Placeholder | Description                                                      |
|-------------|------------------------------------------------------------------|
| `name`      | The validated input or the custom validator name (if specified). |

## Categorization

- Objects
- Structures

## Changelog

| Version | Description |
|--------:|-------------|
|   3.0.0 | Created     |

***
See also:

- [ObjectType](ObjectType.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
