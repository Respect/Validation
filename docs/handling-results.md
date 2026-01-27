<!--
SPDX-FileCopyrightText: (c) Respect Project Contributors
SPDX-License-Identifier: MIT
-->

# Handling results

The `ResultQuery` class provides a fluent interface for inspecting validation results. It's returned by the `validate()` method and offers methods to check validity, retrieve error messages, and query nested validation results.

## Basic usage

```php
use Respect\Validation\ValidatorBuilder as v;

$result = v::intType()->positive()->validate($input);
if ($result->hasFailed()) {
    echo $result->getMessage();
}
```

## Checking validity

### hasFailed()

Returns `true` if validation passed, `false` otherwise.

```php
$result = v::email()->validate('user@example.com');
$result->hasFailed(); // false

$result = v::email()->validate('not-an-email');
$result->hasFailed(); // true
```

## Retrieving messages

### getMessage()

Returns the first error message from the validation result. Returns an empty string if validation passed.

```php
$result = v::intType()->validate('not an integer');

echo $result->getMessage();
// → "not an integer" must be an integer
```

### getFullMessage()

Returns a complete error tree showing all validation failures in a nested Markdown list format. Useful for debugging or displaying comprehensive error feedback.

```php
$result = v::alnum()->lowercase()->validate('The Panda');

echo $result->getFullMessage();
// → - "The Panda" must pass all the rules
// →   - "The Panda" must contain only letters (a-z) and digits (0-9)
// →   - "The Panda" must contain only lowercase letters
```

### getMessages()

Returns all error messages as an associative array. Keys correspond to validator IDs or paths.

```php
$result = v::alnum()->lowercase()->validate('The Panda');

print_r($result->getMessages());
// Array
// (
//     [__root__] => "The Panda" must pass all the rules
//     [alnum] => "The Panda" must contain only letters (a-z) and digits (0-9)
//     [lowercase] => "The Panda" must contain only lowercase letters
// )
```

For nested structures, keys reflect the path:

```php
$result = v::init()
    ->key('name', v::stringType())
    ->key('age', v::intType())
    ->validate(['name' => 123, 'age' => 'twenty']);

print_r($result->getMessages());
// Array
// (
//     [__root__] => `["name": 123, "age": "twenty"]` must pass all the rules
//     [name] => name must be a string
//     [age] => age must be an integer
// )
```

### String conversion

`ResultQuery` implements `Stringable`, so you can use it directly in string contexts. It returns the same value as `getMessage()`.

```php
$result = v::email()->validate('invalid');
echo $result; // "invalid" must be a valid email address
```

## Querying nested results

When validating complex nested structures, `ResultQuery` provides methods to find and inspect specific parts of the validation result tree.

### Return values

All finder methods (`findByPath()`, `findByName()`, `findById()`) return either:
- A new `ResultQuery` instance wrapping the found result
- `null` if no matching result was found

This allows safe chaining with null checks:

```php
$result = $validator->validate($input);

$nested = $result->findByPath('user.profile.email');
if ($nested?->hasFailed()) {
    echo $nested->getMessage();
}
```

### findByPath()

Finds a result by its path through the data structure. Supports dot notation for nested paths.

```php
$result = v::init()
    ->key('user', v::key('email', v::email()))
    ->validate(['user' => ['email' => 'invalid']]);

// Find the email validation result
$emailResult = $result->findByPath('user.email');
if ($emailResult?->hasFailed()) {
    echo $emailResult->getMessage();
    // → `.user.email` must be a valid email address
}
```

Paths can also be integers for array indices:

```php
$result = v::init()
    ->each(v::positive())
    ->validate([10, -5, 20]);

// Find the result for index 1
$itemResult = $result->findByPath(1);
if ($itemResult?->hasFailed()) {
    echo $itemResult->getMessage();
    // → `.1` must be a positive number
}
```

Combined paths work too:

```php
$result = v::init()
    ->each(
        v::key('email', v::email()),
    )
    ->validate([
        ['email' => 'valid@example.com'],
        ['email' => 'invalid'],
    ]);

// Find the email of the second item
$emailResult = $result->findByPath('1.email');
if ($emailResult?->hasFailed()) {
    echo $emailResult->getMessage();
    // → `.1.email` must be a valid email address
}
```

### findByName()

Finds a result by a custom name assigned with the `Named` validator.

```php
$result = v::named('User Email', v::email())->validate('invalid');

echo $result->findByName('User Email');
// → User Email must be a valid email address
```

This is useful when you need to locate results by semantic names rather than structural paths:

```php
$result = v::init()
    ->key(
        'contact',
        v::named('Primary Email', v::key('email', v::email())),
    )
    ->validate(['contact' => ['email' => 'bad']]);

echo $result->findByName('Primary Email');
// → `.contact.email` (<- Primary Email) must be a valid email address
```

### findById()

Finds a result by validator ID. IDs are automatically generated from validator class names (e.g., `StringType` becomes `stringType`).

```php
$result = v::stringType()->email()->validate(123);

echo $result->findById('stringType');
// → 123 must be a string
```

## Practical patterns

### Checking specific field validity

```php
$result = v::init()
    ->key('email', v::email())
    ->key('age', v::intType()->positive())
    ->validate($formData);

// Check if email specifically is valid
$emailResult = $result->findByPath('email');
if ($emailResult?->hasFailed()) {
    // Email failed validation
}
```

### Collecting errors for specific fields

```php
$result = v::init()
    ->key('username', v::alnum()->lengthBetween(3, 20))
    ->key('password', v::lengthGreaterThanOrEqual(8))
    ->validate($input);

$errors = [
    'username' => $result->findByPath('username')?->getMessage(),
    'password' => $result->findByPath('password')?->getMessage(),
];
```

### Validating arrays of items

```php
$items = [
    ['name' => 'Widget', 'price' => 10],
    ['name' => 123, 'price' => -5],
    ['name' => 'Gadget', 'price' => 20],
];

$result = v::init()
    ->each(
        v::init()
            ->key('name', v::stringType())
            ->key('price', v::positive())
    )
    ->validate($items);

// Check each item individually
for ($i = 0; $i < count($items); $i++) {
    $itemResult = $result->findByPath($i);
    if ($itemResult !== null && !$itemResult->hasFailed()) {
        echo "Item $i has errors: " . $itemResult->getMessage() . "\n";
    }
}

// Or get a specific field from a specific item
$priceResult = $result->findByPath('1.price');
if ($priceResult !== null) {
    echo $priceResult->getMessage();
    // → `.1.price` must be a positive number
}
```

### Combining with custom templates

```php
$result = v::init()
    ->key('email', v::email())
    ->key('age', v::intType())
    ->validate($input, [
        'email' => 'Please provide a valid email address',
        'age' => 'Age must be a whole number',
    ]);

$emailResult = $result->findByPath('email');
if ($emailResult?->hasFailed()) {
    echo $emailResult->getMessage();
    // → Please provide a valid email address
}
```
