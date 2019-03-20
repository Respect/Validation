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

/**
 * @author Mazen Touati <mazen_touati@hotmail.com>
 */

namespace Respect\Validation\Helpers\Data\Loaders;

use function file_get_contents;
use function json_decode;

class JsonLoader implements DataLoader
{
    /**
     * @return mixed[][]
     */
    public function load(string $filePath): array
    {
        return json_decode(file_get_contents($filePath), true);
    }
}
