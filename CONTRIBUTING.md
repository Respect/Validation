# Contributing

Contributions to Respect\Validation are always welcome. You make our lives
easier by sending us your contributions through
[GitHub pull requests](http://help.github.com/pull-requests).

Pull requests for bug fixes must be based on the current stable branch whereas
pull requests for new features must be based on `master`.

Due to time constraints, we are not always able to respond as quickly as we
would like. Please do not take delays personal and feel free to remind us here,
on IRC, or on Gitter if you feel that we forgot to respond.

Please see the [project documentation](http://respect.github.io/Validation)
before proceeding. You should also know about [PHP-FIG](http://www.php-fig.org)'s
standards and basic unit testing, but we're sure you can learn that just by
looking at other rules. Pick the simple ones like `Int` to begin.

Before writing anything, make sure there is no validator that already does what
you need. Also, it would be awesome if you
[open an issue](http://github.com/Respect/Validation/issues) before starting,
so if anyone has the same idea the guy will see that you're already doing that.

## Adding a new validator

A common validator (rule) on Respect\Validation is composed of three classes:

  * `library/Rules/YourRuleName.php`: the rule itself
  * `library/Exceptions/YourRuleNameException.php`: the exception thrown by the rule
  * `tests/Rules/YourRuleNameTest.php`: tests for the rule

Classes are pretty straightforward. In the sample below, we're going to create a
validator that validates if a string is equal "Hello World".

## Samples

The rule itself needs to implement the `Validatable` interface.
Also, it is convenient to extend the `AbstractRule`.
Doing that, you'll only need to declare one method: `validate($input)`.
This method must return `true` or `false`.

If your validator class is `HelloWorld`, it will be available as `v::helloWorld()`
and will natively have support for chaining and everything else.

```php
namespace Respect\Validation\Rules;

class HelloWorld extends AbstractRule
{
    public function validate($input)
    {
        return $input === 'Hello World';
    }
}
```

Just that and we're done with the rule code. The Exception requires you to
declare messages used by `assert()` and `check()`. Messages are declared in
affirmative and negative moods, so if anyone calls `v::not(v::helloWorld())` the
library will show the appropriate message.

```php
namespace Respect\Validation\Exceptions;

class HelloWorldException extends ValidationException
{
    public static $defaultTemplates = array(
        self::MODE_DEFAULT => array(
            self::STANDARD => '{{name}} must be a Hello World',
        ),
        self::MODE_NEGATIVE => array(
            self::STANDARD => '{{name}} must not be a Hello World',
        )
    );
}
```

Finally, we need to test if everything is running smooth:

```php
namespace Respect\Validation\Rules;

class HelloWorldTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldValidateAValidHelloWorld()
    {
        $rule = new HelloWorld();

        $this->assertTrue($rule->validate('Hello World'));
    }

    public function testNotValidateAnInvalidHelloWorld()
    {
        $rule = new HelloWorld();

        $this->assertFalse($rule->validate('Hello Moon'));
    }

    /**
     * @expectedException Respect\Validation\Exceptions\HelloWorldException
     * @expectedExceptionMessage "Hello Mars" must be a Hello World
     */
    public function testShouldThowsTheRightExceptionWhenChecking()
    {
        $rule = new HelloWorld();

        $rule->check('Hello Mars');
    }
}
```

PS.: We strongly recommend you use [Data Providers](https://phpunit.de/manual/current/en/writing-tests-for-phpunit.html#writing-tests-for-phpunit.data-providers).

## Documentation

Our docs at http://respect.github.io/Validation are generated from our Markdown
files using [Couscous](http://couscous.io/). Add your brand new rule there and
everything will be updated as soon as possible.

## Running Tests

After run `composer install` on the library's root directory you must run PHPUnit.

### Linux

You can test the project using the commands:
```sh
$ vendor/bin/phpunit
```

### Windows

You can test the project using the commands:
```sh
> vendor\bin\phpunit
```

No test should fail.

You can tweak the PHPUnit's settings by copying `phpunit.xml.dist` to `phpunit.xml`
and changing it according to your needs.

***

See also:

- [Feature Guide](docs/README.md)
- [Installation](docs/INSTALL.md)
- [License](LICENSE.md)
- [Validators](docs/VALIDATORS.md)
