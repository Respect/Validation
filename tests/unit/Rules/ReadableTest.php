<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Psr\Http\Message\StreamInterface;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use stdClass;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Readable
 *
 * @author Danilo Correa <danilosilva87@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class ReadableTest extends RuleTestCase
{
    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $file = $this->getFixtureDirectory() . '/valid-image.gif';
        $rule = new Readable();

        return [
            [$rule, $file],
            [$rule, new SplFileInfo($file)],
            [$rule, $this->createPsr7Stream(true)],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $file = $this->getFixtureDirectory() . '/invalid-image.gif';
        $rule = new Readable();

        return [
            [$rule, $file],
            [$rule, new SplFileInfo($file)],
            [$rule, new stdClass()],
            [$rule, $this->createPsr7Stream(false)],
        ];
    }

    private function createPsr7Stream(bool $isReadable): StreamInterface
    {
        $stream = $this->createMock(StreamInterface::class);
        $stream->expects(self::any())->method('isReadable')->willReturn($isReadable);

        return $stream;
    }
}
