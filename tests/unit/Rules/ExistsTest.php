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

use org\bovigo\vfs\content\LargeFileContent;
use org\bovigo\vfs\vfsStream;
use Respect\Validation\Test\RuleTestCase;
use SplFileInfo;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Exists
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Kennedy Tedesco <kennedyt.tw@gmail.com>
 * @author William Espindola <oi@williamespindola.com.br>
 */
final class ExistsTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $rule = new Exists();

        $root = vfsStream::setup();
        $file = vfsStream::newFile('2kb.txt')
            ->withContent(LargeFileContent::withKilobytes(2))
            ->at($root);

        $object = new SplFileInfo($file->url());

        return [
            [$rule, $file->url()],
            [$rule, $object],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Exists();

        return [
            [$rule, '/path/of/a/non-existent/file'],
        ];
    }
}
