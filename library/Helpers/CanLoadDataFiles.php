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

namespace Respect\Validation\Helpers;

use function file_exists;
use function file_get_contents;
use function json_decode;

trait CanLoadDataFiles
{
    private function getPath(string $basename): string
    {
        return __DIR__.'/../../data/'.$basename;
    }

    private function isValidFile(string $basename): bool
    {
        return file_exists($this->getPath($basename));
    }

    /**
     * @return mixed[]
     */
    private function getDataFromFile(string $basename): array
    {
        return json_decode(file_get_contents($this->getPath($basename)), true);
    }
}
