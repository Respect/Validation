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

use finfo;
use is_file;
use is_string;
use mb_strpos;
use SplFileInfo;

/**
 * @author Danilo Benevides <danilobenevides01@gmail.com>
 * @author Guilherme Siani <guilherme@siani.com.br>
 * @author Henrique Moody <henriquemoody@gmail.com>
 */
final class Image extends AbstractRule
{
    public $fileInfo;

    public function __construct(finfo $fileInfo = null)
    {
        $this->fileInfo = $fileInfo ?: new finfo(FILEINFO_MIME_TYPE);
    }

    public function validate($input): bool
    {
        if ($input instanceof SplFileInfo) {
            $input = $input->getPathname();
        }

        if (!is_string($input)) {
            return false;
        }

        if (!is_file($input)) {
            return false;
        }

        return 0 === mb_strpos($this->fileInfo->file($input), 'image/');
    }
}
