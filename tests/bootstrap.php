<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

$mockIsUploadedFileReturn = true;

if (!function_exists('mock_is_uploaded_file')) {
    function mock_is_uploaded_file(string $filename): bool
    {
        global $mockIsUploadedFileReturn;

        return $mockIsUploadedFileReturn;
    }
}

if (!function_exists('set_mock_is_uploaded_file_return')) {
    function set_mock_is_uploaded_file_return(bool $return): void
    {
        global $mockIsUploadedFileReturn;

        $mockIsUploadedFileReturn = $return;
    }
}
