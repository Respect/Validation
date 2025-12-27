# Attributes

- `Attributes()`

Validates the PHP attributes defined in the properties of the input.

Example of object:

```php
use Respect\Validation\Rules as Rule;

#[Rule\AnyOf(
    new Rule\Property('email', new Rule\NotUndef()),
    new Rule\Property('phone', new Rule\NotUndef()),
)]
final class Person
{
    public function __construct(
        #[Rule\NotEmpty]
        public string $name,
        #[Rule\Date('Y-m-d')]
        #[Rule\DateTimeDiff('years', new Rule\LessThanOrEqual(25))]
        public string $birthdate,
        #[Rule\Email]
        public ?string $email = null,
        #[Rule\Phone]
        public ?string $phone = null,
    ) {
    }
}
```

Here is how you can validate the attributes of the object:

```php
v::attributes()->assert(new Person('John Doe', '2020-06-23', 'john.doe@gmail.com'));
// No exception

v::attributes()->assert(new Person('John Doe', '2020-06-23', 'john.doe@gmail.com', '+12024561111'));
// No exception

v::attributes()->assert(new Person('', '2020-06-23', 'john.doe@gmail.com', '+12024561111'));
// Message: `.name` must not be empty

v::attributes()->assert(new Person('John Doe', 'not a date', 'john.doe@gmail.com', '+12024561111'));
// Message: `.birthdate` must be a valid date in the format "2005-12-30"

v::attributes()->assert(new Person('John Doe', '2020-06-23', 'not an email', '+12024561111'));
// Message: `.email` must be a valid email address or must be null

v::attributes()->assert(new Person('John Doe', '2020-06-23', 'john.doe@gmail.com', 'not a phone number'));
// Message: `.phone` must be a valid telephone number or must be null

v::attributes()->assert(new Person('John Doe', '2020-06-23'));
// Full message:
// - `Person { +$name="John Doe" +$birthdate="2020-06-23" +$email=null +$phone=null +$address=null }` must pass at least one of the rules
//  - `.email` must be defined
//  - `.phone` must be defined

v::attributes()->assert(new Person('', 'not a date', 'not an email', 'not a phone number'));
// Full message:
// - `Person { +$name="" +$birthdate="not a date" +$email="not an email" +$phone="not a phone number" +$address=null }` must pass the rules
//   - `.name` must not be empty
//   - `.birthdate` must pass all the rules
//     - `.birthdate` must be a valid date in the format "2005-12-30"
//     - For comparison with now, `.birthdate` must be a valid datetime
//   - `.email` must be a valid email address or must be null
//   - `.phone` must be a valid telephone number or must be null
```

## Caveats

- If the object has no attributes, the validation will always pass.
- When the property is nullable, this rule will wrap the rule on the property into [NullOr](NullOr.md) rule.
- This rule has no templates because it uses the templates of the rules that are applied to the properties.

## Categorization

- Objects
- Structures

## Changelog

| Version | Description |
| ------: | ----------- |
|   3.0.0 | Created     |

---

See also:

- [Named](Named.md)
- [NullOr](NullOr.md)
- [ObjectType](ObjectType.md)
- [Property](Property.md)
- [PropertyExists](PropertyExists.md)
- [PropertyOptional](PropertyOptional.md)
- [Templated](Templated.md)
