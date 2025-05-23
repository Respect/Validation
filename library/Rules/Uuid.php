<?php

/*
 * Copyright (c) Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-License-Identifier: MIT
 */

declare(strict_types=1);

namespace Respect\Validation\Rules;

use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface;
use Respect\Validation\Exceptions\ComponentException;

use function class_exists;
use function is_string;
use function preg_match;
use function sprintf;

/**
 * Validates whether the input is a valid UUID.
 *
 * It also supports validation of specific versions 1, 3, 4 and 5.
 *
 * @author Dick van der Heiden <d.vanderheiden@inthere.nl>
 * @author Henrique Moody <henriquemoody@gmail.com>
 * @author Michael Weimann <mail@michael-weimann.eu>
 */
final class Uuid extends AbstractRule
{
    /**
     * Placeholder in "sprintf()" format used to create the REGEX that validates inputs.
     */
    private const PATTERN_FORMAT = '/^[0-9a-f]{8}-[0-9a-f]{4}-%s[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i';

    /**
     * The UUID version to validate for.
     *
     */
    private ?int $version;

    /**
     * Whether to use Ramsey/Uuid to validate the UUID.
     *
     */
    private bool $useRamseyUuid = false;

    /**
     * Whether Ramsey/Uuid is loaded.
     *
     */
    private static ?bool $ramseyUuidIsLoaded = null;

    /**
     * Initializes the rule with the desired version.
     *
     * @throws ComponentException when the version is not valid
     */
    public function __construct(?int $version = null, ?bool $useRamseyUuid = null)
    {
        if ($useRamseyUuid && !$this->ramseyUuidIsLoaded()) {
            throw new ComponentException('Ramsey/Uuid is not installed');
        }

        $this->useRamseyUuid = $useRamseyUuid ?? $this->ramseyUuidIsLoaded();

        if ($version !== null && !$this->isSupportedVersion($version)) {
            if ($this->useRamseyUuid) {
                throw new ComponentException(sprintf('Only versions 1 to 8 are supported: %d given', $version));
            }

            throw new ComponentException(sprintf('Only versions 1, 3, 4, and 5 are supported: %d given', $version));
        }

        $this->version = $version;
    }

    /**
     * @deprecated Calling `validate()` directly from rules is deprecated. Please use {@see \Respect\Validation\Validator::isValid()} instead.
     */
    public function validate($input): bool
    {
        if ($this->useRamseyUuid) {
            if (!is_string($input) && !($input instanceof UuidInterface)) {
                return false;
            }

            if (is_string($input) && RamseyUuid::isValid($input)) {
                $input = RamseyUuid::fromString($input);
            }

            if ($input instanceof UuidInterface) {
                if ($this->version !== null) {
                    return $input->getVersion() === $this->version;
                }

                return $input->getVersion() !== null;
            }

            return false;
        }

        if (!is_string($input)) {
            return false;
        }

        return preg_match($this->getPattern(), $input) > 0;
    }

    private function isSupportedVersion(int $version): bool
    {
        return $this->useRamseyUuid ? $version >= 1 && $version <= 8 : $version >= 1 && $version <= 5 && $version !== 2;
    }

    private function getPattern(): string
    {
        if ($this->version !== null) {
            return sprintf(self::PATTERN_FORMAT, $this->version);
        }

        return sprintf(self::PATTERN_FORMAT, '[13-5]');
    }

    private function ramseyUuidIsLoaded(): bool
    {
        if (self::$ramseyUuidIsLoaded === null) {
            self::$ramseyUuidIsLoaded = class_exists(RamseyUuid::class);
        }

        return self::$ramseyUuidIsLoaded;
    }
}
