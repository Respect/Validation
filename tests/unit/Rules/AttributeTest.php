<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use stdClass;

/**
 * @group rule
 *
 * @covers Respect\Validation\Rules\Attribute
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class AttributeTest extends RuleTestCase2
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $object1 = new stdClass();
        $object1->foo = 'foo';

        $object2 = new stdClass();
        $object2->bar = '';

        $object3 = new stdClass();
        $object3->{0} = '';

        $object4 = new PrivClass();

        return [
            [new Attribute('foo'), $object1],
            [new Attribute('foo', $this->createRuleMock(true, $object1->foo)), $object1],
            [new Attribute('bar', $this->createRuleMock(false, null), false), $object1],
            [new Attribute('bar'), $object2],
            [new Attribute('bar', $this->createRuleMock(true, $object2->bar)), $object2],
            [new Attribute('foo', $this->createRuleMock(false, null), false), $object2],
            [new Attribute(0), $object3],
            [new Attribute('baz'), $object4],
            [new Attribute('baz', $this->createRuleMock(true, 'baz')), $object4],
            [new Attribute('foo', $this->createRuleMock(false, null), false), $object4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $object1 = new stdClass();
        $object1->foo = 'foo';

        $object2 = new PrivClass();

        return [
            [new Attribute('bar'), $object1],
            [new Attribute('foo', $this->createRuleMock(false, $object1->foo)), $object1],
            [new Attribute('foo', $this->createRuleMock(false, $object1->foo), false), $object1],
            [new Attribute('foo'), $object2],
            [new Attribute('baz', $this->createRuleMock(false, 'baz')), $object2],
            [new Attribute('baz', $this->createRuleMock(false, 'baz'), false), $object2],
        ];
    }

    /**
     * @test
     */
    public function shouldThrowAnExceptionWhenAttributeNameIsEmpty()
    {
        $this->expectException(ComponentException::class, 'Attribute name cannot be empty');

        new Attribute('');
    }
}

class PrivClass
{
    private $baz = 'baz';
}
