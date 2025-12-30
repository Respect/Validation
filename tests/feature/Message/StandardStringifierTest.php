<?php

declare(strict_types=1);

use Respect\Validation\Message\ValidationStringifier;

test('Should return `unknown` when cannot stringify value', function (): void {
    $resource = tmpfile();
    fclose($resource);

    $stringifier = new ValidationStringifier();

    expect($stringifier->stringify($resource, 0))->toBe('`unknown`');
});
