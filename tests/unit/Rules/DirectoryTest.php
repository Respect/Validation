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

use Respect\Validation\Test\RuleTestCase;
use function array_map;
use function is_dir;
use function mkdir;
use function realpath;
use function SplFileObject;
use function sys_get_temp_dir;

/**
 * @group rule
 *
 * @covers \Respect\Validation\Rules\Directory
 *
 * @author Gabriel Caruso <carusogabriel34@gmail.com>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author William Espindola <oi@williamespidolacom.br>
 */
final class DirectoryTest extends RuleTestCase
{
    /**
     * {@inheritdoc}
     */
    public function providerForValidInput(): array
    {
        $directories = [
            sys_get_temp_dir().DIRECTORY_SEPARATOR.'dataprovider-1',
            sys_get_temp_dir().DIRECTORY_SEPARATOR.'dataprovider-2',
            sys_get_temp_dir().DIRECTORY_SEPARATOR.'dataprovider-3',
            sys_get_temp_dir().DIRECTORY_SEPARATOR.'dataprovider-4',
            sys_get_temp_dir().DIRECTORY_SEPARATOR.'dataprovider-5',
        ];

        $rule = new Directory();

        $directories = array_map(
            function ($directory) use ($rule) {
                if (!is_dir($directory)) {
                    mkdir($directory, 0766, true);
                }

                return [$rule, realpath($directory)];
            },
            $directories
        );

        $directories = $directories + [$rule, new \SplFileInfo(__DIR__)];

        return $directories;
    }

    /**
     * {@inheritdoc}
     */
    public function providerForInvalidInput(): array
    {
        $rule = new Directory();

        return [
            /*
             * PHP 5.4 does not allows to use SplFileObject with directories.
             * array(new \SplFileObject(__DIR__), true),
             */
            [$rule, new \SplFileObject(__FILE__)],
            [$rule, ''],
            [$rule, __FILE__],
            [$rule, __DIR__.'/../../../../../README.md'],
            [$rule, __DIR__.'/../../../../../composer.json'],
            [$rule, new \stdClass()],
            [$rule, [__DIR__]],
        ];
    }
}
