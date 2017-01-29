<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Respect\Validation\Exceptions\ComponentException;
use Respect\Validation\Test\RuleTestCase;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Attribute
 *
 * @author Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 0.3.9
 */
final class AttributeTest extends RuleTestCase
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
            [new Attribute('foo', $this->createRuleMock($object1->foo, true)), $object1],
            [new Attribute('bar', $this->createRuleMock(null, false), false), $object1],
            [new Attribute('bar'), $object2],
            [new Attribute('bar', $this->createRuleMock($object2->bar, true)), $object2],
            [new Attribute('foo', $this->createRuleMock(null, false), false), $object2],
            [new Attribute(0), $object3],
            [new Attribute('baz'), $object4],
            [new Attribute('baz', $this->createRuleMock('baz', true)), $object4],
            [new Attribute('foo', $this->createRuleMock(null, false), false), $object4],
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
            [new Attribute('foo', $this->createRuleMock($object1->foo, false)), $object1],
            [new Attribute('foo', $this->createRuleMock($object1->foo, false), false), $object1],
            [new Attribute('foo'), $object2],
            [new Attribute('baz', $this->createRuleMock('baz', false)), $object2],
            [new Attribute('baz', $this->createRuleMock('baz', false), false), $object2],
        ];
    }

    /**
     * @test
     */
    public function shouldThrowAnExceptionWhenAttributeNameIsEmpty(): void
    {
        $this->expectException(ComponentException::class, 'Attribute name cannot be empty');

        new Attribute('');
    }
}

class PrivClass
{
    private $baz = 'baz';
}
