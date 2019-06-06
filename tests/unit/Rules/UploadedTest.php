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

use PHPUnit\Framework\SkippedTestError;
use Psr\Http\Message\UploadedFileInterface;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;
use stdClass;

use function extension_loaded;
use function uopz_set_return;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Uploaded
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Paul Karikari <paulkarikari1@gmail.com>
 */
final class UploadedTest extends RuleTestCase
{
    public const UPLOADED_FILENAME = 'uploaded.ext';

    /**
     * {@inheritDoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Uploaded();

        return [
            [$rule, self::UPLOADED_FILENAME],
            [$rule, new SplFileInfo(self::UPLOADED_FILENAME)],
            [$rule, $this->createMock(UploadedFileInterface::class)],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Uploaded();

        return [
            [$rule, 'not-uploaded.ext'],
            [$rule, new SplFileInfo('not-uploaded.ext')],
            [$rule, []],
            [$rule, 1],
            [$rule, new stdClass()],
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        if (!extension_loaded('uopz')) {
            throw new SkippedTestError('Extension "uopz" is required to test "Uploaded" rule');
        }

        uopz_set_return(
            'is_uploaded_file',
            static function (string $filename): bool {
                return $filename === UploadedTest::UPLOADED_FILENAME;
            },
            true
        );
    }
}
