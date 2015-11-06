<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

use finfo;
use SplFileInfo;

class Image extends AbstractRule
{
    public $fileInfo;

    public function __construct(finfo $fileInfo = null)
    {
        $this->fileInfo = $fileInfo ?: new finfo(FILEINFO_MIME_TYPE);
    }

    public function validate($input)
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

        return (0 === strpos($this->fileInfo->file($input), 'image/'));
    }
}
