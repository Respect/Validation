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

namespace Respect\Validation;

use ArrayIterator;
use DateTime;
use DateTimeImmutable;
use Exception;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @group engine
 *
 * @covers \Respect\Validation\Message\Formatter
 *
 * @author Henrique Moody <henriquemoody@gmail.com>
 *
 * @since 2.0.0
 */
final class MessageTest extends TestCase
{
    /**
     * @test
     */
    public function shouldDefineAndRetrieveRuleName(): void
    {
        $ruleName = 'MyRuleName';

        $message = new Message($ruleName, 'template', 'input');

        self::assertSame($ruleName, $message->getRuleName());
    }

    /**
     * @test
     */
    public function shouldUseInputAsPlaceholderWhenNoPlaceholderIsDefined(): void
    {
        $template = 'This is a message with {{placeholder}}';

        $message = new Message('RuleName', $template, 12345);

        $expectedMessage = 'This is a message with 12345';

        self::assertSame($expectedMessage, $message->render());
    }

    /**
     * @test
     */
    public function shouldUsePlaceholderParameterWhenNoPlaceholderKeyIsDefined(): void
    {
        $template = 'This is a message with {{placeholder}}';

        $message = new Message('RuleName', $template, 12345);

        $expectedMessage = 'This is a message with placeholder';

        self::assertSame($expectedMessage, $message->render('placeholder'));
    }

    /**
     * @test
     */
    public function shouldUsePlaceholderKeyAsPlaceholderWhenDefined(): void
    {
        $template = 'This is a message with {{placeholder}}';

        $message = new Message('RuleName', $template, 123, ['placeholder' => 456]);

        $expectedMessage = 'This is a message with 456';

        self::assertSame($expectedMessage, $message->render(789));
    }

    /**
     * @test
     */
    public function shouldNotStringifyPlaceholderKey(): void
    {
        $template = 'This is a message with {{placeholder}}';

        $message = new Message('RuleName', $template, 12345, ['placeholder' => 'some name']);

        $expectedMessage = 'This is a message with some name';

        self::assertSame($expectedMessage, $message->render());
    }

    /**
     * @test
     */
    public function shouldReplaceAllProperties(): void
    {
        $template = '{{foo}}, {{bar}}, and {{baz}}';
        $properties = ['foo' => 1, 'bar' => 2, 'baz' => 3];

        $message = new Message('RuleName', $template, 'input', $properties);

        $expectedMessage = '1, 2, and 3';

        self::assertSame($expectedMessage, $message->render());
    }

    /**
     * @test
     */
    public function shouldStringifyAllProperties(): void
    {
        $template = '{{foo}}, {{bar}}, and {{baz}}';
        $properties = ['foo' => true, 'bar' => 'name', 'baz' => new stdClass()];

        $message = new Message('RuleName', $template, 'input', $properties);

        $expectedMessage = '`true`, "name", and `[object] (stdClass: { })`';

        self::assertSame($expectedMessage, $message->render());
    }
}
