<?php

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
