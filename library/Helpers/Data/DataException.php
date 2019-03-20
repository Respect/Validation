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

namespace Respect\Validation\Helpers\Data;

use RuntimeException;

/**
 * @author Mazen Touati <mazen_touati@hotmail.com>
 */
class DataException extends RuntimeException
{
    public const NO_FILE_PROVIDED = 1;
    public const FILE_NOT_FOUND = 2;
    public const LOADER_NOT_SUPPORTED = 3;
    public const VALUE_NOT_FOUND = 4;

    public static function noFileProvided(): DataException
    {
        return new static(
            'No valid filename has been provided.',
            self::NO_FILE_PROVIDED
        );
    }

    public static function fileNotFound(string $path): DataException
    {
        return new static(
            'Unable to locate the following file { '.$path.' }.',
            self::FILE_NOT_FOUND
        );
    }

    public static function loaderNotSupported(string $ext): DataException
    {
        return new static(
            'There\'s no available loader that supports the following extention { '.$ext.' }.',
            self::LOADER_NOT_SUPPORTED
        );
    }

    public static function valueNotFound(string $path): DataException
    {
        return new static(
            'The following dot path { '.$path.' } does not point to any value.',
            self::VALUE_NOT_FOUND
        );
    }
}
