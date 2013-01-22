<?php
namespace Respect\Validation\Exceptions;

use Respect\Validation\Validator as v;

class AbstractNestedExceptionTest extends \PHPUnit_Framework_TestCase
{
    public function testGetRelatedShouldReturnExceptionAddedByAddRelated()
    {
        $composite = new AttributeException;
        $node = new IntException;
        $composite->addRelated($node);
        $this->assertEquals(1, count($composite->getRelated(true)));
        $this->assertContainsOnly($node, $composite->getRelated());
    }

    public function testAddingTheSameInstanceShouldAddJustASingleReference()
    {
        $composite = new AttributeException;
        $node = new IntException;
        $composite->addRelated($node);
        $composite->addRelated($node);
        $composite->addRelated($node);
        $this->assertEquals(1, count($composite->getRelated(true)));
        $this->assertContainsOnly($node, $composite->getRelated());
    }

    public function testFindRelatedShouldFindCompositeExceptions()
    {
        $foo = new AttributeException;
        $bar = new AttributeException;
        $baz = new AttributeException;
        $bat = new AttributeException;
        $foo->configure('foo');
        $bar->configure('bar');
        $baz->configure('baz');
        $bat->configure('bat');
        $foo->addRelated($bar);
        $bar->addRelated($baz);
        $baz->addRelated($bat);
        $this->assertSame($bar, $foo->findRelated('bar'));
        $this->assertSame($baz, $foo->findRelated('baz'));
        $this->assertSame($baz, $foo->findRelated('bar.baz'));
        $this->assertSame($baz, $foo->findRelated('baz'));
        $this->assertSame($bat, $foo->findRelated('bar.bat'));
        $this->assertSame(false, $foo->findRelated('none'));
        $this->assertSame(false, $foo->findRelated('bar.none'));
    }

    public function testFindMessagesShouldReturnCompositeValidationMessagesFlattened()
    {
        $stringMax256 = v::string()->length(5, 256);
        $alnumDot = v::alnum('.');
        $stringMin8 = v::string()->length(8, null);
        $v = v::allOf(
                v::attribute('first_name', $stringMax256)->setName('First Name'),
                v::attribute('last_name', $stringMax256)->setName('Last Name'),
                v::attribute('desired_login', $alnumDot)->setName('Desired Login'),
                v::attribute('password', $stringMin8)->setName('Password'),
                v::attribute('password_confirmation', $stringMin8)->setName('Password Confirmation'),
                v::attribute('stay_signedin', v::notEmpty())->setName('Stay signed in'),
                v::attribute('enable_webhistory', v::notEmpty())->setName('Enabled Web History'),
                v::attribute('security_question', $stringMax256)->setName('Security Question')
            )->setName('Validation Form');
        try {
            $v->assert(
                (object) array(
                    'first_name' => 'fiif',
                    'last_name' => null,
                    'desired_login' => null,
                    'password' => null,
                    'password_confirmation' => null,
                    'stay_signedin' => null,
                    'enable_webhistory' => null,
                    'security_question' => null,
                )
            );
        } catch (ValidationException $e) {
            $messages = $e->findMessages(
                    array('allOf', 'first_name.length')
            );
            $this->assertEquals($messages['allOf'],
                'These rules must pass for Validation Form');
            $this->assertEquals($messages['first_name_length'],
                '"fiif" must have a length between 5 and 256');
        }
    }

    public function testFindMessagesShouldApplyTemplatesToFlattenedMessages()
    {
        $stringMax256 = v::string()->length(5, 256);
        $alnumDot = v::alnum('.');
        $stringMin8 = v::string()->length(8, null);
        $v = v::allOf(
                v::attribute('first_name', $stringMax256)->setName('First Name'),
                v::attribute('last_name', $stringMax256)->setName('Last Name'),
                v::attribute('desired_login', $alnumDot)->setName('Desired Login'),
                v::attribute('password', $stringMin8)->setName('Password'),
                v::attribute('password_confirmation', $stringMin8)->setName('Password Confirmation'),
                v::attribute('stay_signedin', v::notEmpty())->setName('Stay signed in'),
                v::attribute('enable_webhistory', v::notEmpty())->setName('Enabled Web History'),
                v::attribute('security_question', $stringMax256)->setName('Security Question')
            )->setName('Validation Form');
        try {
            $v->assert(
                (object) array(
                    'first_name' => 'fiif',
                    'last_name' => null,
                    'desired_login' => null,
                    'password' => null,
                    'password_confirmation' => null,
                    'stay_signedin' => null,
                    'enable_webhistory' => null,
                    'security_question' => null,
                )
            );
        } catch (ValidationException $e) {
            $messages = $e->findMessages(
                    array(
                        'allOf' => 'Invalid {{name}}',
                        'first_name.length' => 'Invalid length for {{name}} {{input}}'
                    )
            );
            $this->assertEquals($messages['allOf'], 'Invalid Validation Form');
            $this->assertEquals($messages['first_name_length'],
                'Invalid length for "fiif" fiif');
        }
    }
}

