# Concrete API

There are many micro-frameworks that rely on magic methods. We don't. In this
document we're gonna explore the Respect\Validation API without fluent interfaces
or magic methods. We'll use a traditional dependency injection approach.

```php
use Respect\Validation\Validator as v;

$usernameValidator = v::alnum()->noWhitespace()->length(1,15);
$usernameValidator->validate('alganet'); // true
```

If you `var_dump($usernameValidator)`, you'll see a composite of objects with
`Respect\Validation\Rules\Alnum`, `Respect\Validation\Rules\NoWhitespace` and
`Respect\Validation\Rules\Length`. There is a specific object for each rule, and
the chain only builds the structure. You can build it by yourself:

```php
use Respect\Validation\Rules;

$usernameValidator = new Rules\AllOf(
    new Rules\Alnum(),
    new Rules\NoWhitespace(),
    new Rules\Length(1, 15)
);
$usernameValidator->validate('alganet'); // true
```

This is still a very lean API. You can use it in any dependency injection
container or test it in the way you want. Nesting is still possible:

```php
use Respect\Validation\Rules;

$usernameValidator = new Rules\AllOf(
    new Rules\Alnum(),
    new Rules\NoWhitespace(),
    new Rules\Length(1, 15)
);
$userValidator = new Rules\Key('name', $usernameValidator);
$userValidator->validate(['name' => 'alganet']); // true
```

## How It Works?

The Respect\Validation chain is an
[internal DSL](http://martinfowler.com/bliki/InternalDslStyle.html).
It acts in the creational realm of objects (where Abstract Factories and Builders
live), and it's only job is to make rule construction terse and fluent.

## FAQ

> Is `v` in `v::something` a class name?

No! The class is `Respect\Validation\Validator`, we suggest `v` as a very short alias.

> Is `v::something()` a static call?

Yes. Just like the default `DateTime::createFromFormat()` or
`Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration()`. It builds
something complex and returns for you.

> I really don't like static calls, can I avoid it?

Yes. Just use `$validator = new Validator();` each time you want a new validator,
and continue from there.

> Do you have a static method for each rule?

No. We use `__callStatic()`.

> Magic methods are slow! Why do you use them?

They're optional. If you use the `new` interface, they won't be called.

(still, do some benchmarks, you'd be surprised with our implementation).
