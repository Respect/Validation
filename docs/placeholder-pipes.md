# Placeholder Pipes

Validation uses [Stringifier](https://github.com/Respect/Stringifier) to convert values into strings for templates. By default, strings get double quotes around them. With placeholder pipes, you can customize how values are rendered by adding a pipe (`|`) followed by the modifier name to your placeholder.

## Usage

To use a placeholder pipe, modify your placeholder like this: `{{placeholder|modifier}}`

```php
v::templated(
    'The {{field|raw}} field is required',
    v::notEmpty(),
    ['field' => 'email'],
)->assert('');
// → The email field is required
```

## Available Modifiers

### raw

The `raw` modifier removes quotes around values, which is useful for field names or labels that shouldn't look like string values:

```php
v::templated(
    'The {{field|raw}} field is required',
    v::notEmpty(),
    ['field' => 'email'],
)->assert('');
// → The email field is required
// (instead of: The "email" field is required)
```

### quote

The `quote` modifier uses backticks instead of double quotes, which is great for patterns or code-like values:

```php
v::templated(
    'Product SKU must follow the {{pattern|quote}} format',
    v::regex('/^[A-Z]{3}-\d{4}$/'),
    ['pattern' => 'XXX-0000'],
)->assert('invalid-sku');
// → Product SKU must follow the `XXX-0000` format
```

### trans

The `trans` modifier translates the value when using a translator:

```php
v::templated(
    'Le champ {{field|trans}} est invalide',
    v::email(),
    ['field' => 'email_address'], // key in your translation file
)->assert('not-an-email');
// → Le champ "adresse e-mail" est invalide
```

### listOr

The `listOr` modifier formats arrays as readable lists using "or":

```php
v::templated(
    'Status must be {{haystack|listOr}}',
    v::in(['active', 'pending', 'archived']),
)->assert('deleted');
// → Status must be "active", "pending", or "archived"
```

### listAnd

The `listAnd` modifier formats arrays as readable lists using "and":

```php
v::templated(
    'User must have {{roles|listAnd}} roles to perform this action',
    v::callback(fn(User $user) => $user->hasRoles(['admin', 'editor'])),
    ['roles' => ['admin', 'editor']],
)->assert($user);
// → User must have "admin" and "editor" roles to perform this action
```

## Combining with Custom Templates

Placeholder pipes work with both inline templates and `Templated` validators:

```php
// Using with assert()
v::email()->assert($input, 'The {{field|raw}} must be valid', ['field' => 'email']);

// Using with Templated validator
v::templated(
    'The {{field|raw}} must be valid',
    v::email(),
    ['field' => 'email']
)->assert($input);
```

## Nested Validators

Placeholder pipes are particularly useful when working with nested validators:

```php
v::key('age', v::positive())
  ->assert($input, [
    '__root__' => 'Please check your data',
    'age' => 'The {{name|raw}} field must be {{expected|quote}}'
  ]);
```

## Custom Modifiers

You can create custom placeholder pipes by implementing your own stringifier logic when needed for specialized formatting requirements.
