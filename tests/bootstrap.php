<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 * SPDX-FileContributor: Nick Lombard <github@jigsoft.co.za>
 */

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$mockIsUploadedFileReturn = true;

function mock_is_uploaded_file(string $filename): bool
{
    global $mockIsUploadedFileReturn;

    return $mockIsUploadedFileReturn;
}

function set_mock_is_uploaded_file_return(bool $return): void
{
    global $mockIsUploadedFileReturn;

    $mockIsUploadedFileReturn = $return;
}
