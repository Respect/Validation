<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Validators;

use Attribute;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UploadedFileInterface;
use Respect\Validation\Exceptions\InvalidValidatorException;
use Respect\Validation\Message\Template;
use Respect\Validation\Result;
use Respect\Validation\Validator;
use Respect\Validation\Validators\Core\Wrapper;
use SplFileInfo;

use function filesize;
use function is_string;

#[Attribute(Attribute::TARGET_PROPERTY | Attribute::IS_REPEATABLE)]
#[Template(
    'The size in {{unit|trans}} of',
    'The size in {{unit|trans}} of',
    Size::TEMPLATE_STANDARD,
)]
#[Template(
    '{{subject}} must be a filename or an instance of SplFileInfo or a PSR-7 interface',
    '{{subject}} must not be a filename or an instance of SplFileInfo or a PSR-7 interface',
    self::TEMPLATE_WRONG_TYPE,
)]
final class Size extends Wrapper
{
    public const string TEMPLATE_WRONG_TYPE = '__wrong_type__';

    private const array DATA_STORAGE_UNITS = [
        'B' => ['name' => 'bytes', 'bytes' => 1],
        'KB' => ['name' => 'kilobytes', 'bytes' => 1024],
        'MB' => ['name' => 'megabytes', 'bytes' => 1024 ** 2],
        'GB' => ['name' => 'gigabytes', 'bytes' => 1024 ** 3],
        'TB' => ['name' => 'terabytes', 'bytes' => 1024 ** 4],
        'PB' => ['name' => 'petabytes', 'bytes' => 1024 ** 5],
        'EB' => ['name' => 'exabytes', 'bytes' => 1024 ** 6],
        'ZB' => ['name' => 'zettabytes', 'bytes' => 1024 ** 7],
        'YB' => ['name' => 'yottabytes', 'bytes' => 1024 ** 8],
    ];

    /** @param "B"|"KB"|"MB"|"GB"|"TB"|"PB"|"EB"|"ZB"|"YB" $unit */
    public function __construct(
        private readonly string $unit,
        Validator $validator,
    ) {
        if (!isset(self::DATA_STORAGE_UNITS[$unit])) {
            throw new InvalidValidatorException('"%s" is not a recognized data storage unit.', $unit);
        }

        parent::__construct($validator);
    }

    public function evaluate(mixed $input): Result
    {
        $size = $this->getSize($input);
        if ($size === null) {
            return Result::failed($input, $this, [], self::TEMPLATE_WRONG_TYPE)
                ->withId($this->validator->evaluate($input)->id->withPrefix('size'));
        }

        $result = $this->validator->evaluate($this->getSize($input) / self::DATA_STORAGE_UNITS[$this->unit]['bytes']);
        $parameters = ['unit' => self::DATA_STORAGE_UNITS[$this->unit]['name']];

        return $result->asAdjacentOf(
            Result::of($result->hasPassed, $input, $this, $parameters),
            'size',
        );
    }

    private function getSize(mixed $input): int|null
    {
        if (is_string($input)) {
            return (int) filesize($input);
        }

        if ($input instanceof SplFileInfo) {
            return $input->getSize();
        }

        if ($input instanceof UploadedFileInterface) {
            return $input->getSize();
        }

        if ($input instanceof StreamInterface) {
            return $input->getSize();
        }

        return null;
    }
}
