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

namespace Respect\Validation\Helpers\Data;

use function class_exists;
use function explode;
use function is_file;
use function is_null;
use function is_string;
use function pathinfo;
use function ucfirst;
use const DIRECTORY_SEPARATOR;
use const PATHINFO_EXTENSION;

/**
 * An Utility that validates and loads data files
 *
 * @author Mazen Touati <mazen_touati@hotmail.com>
 */
class Data
{
    /**
     * Default directory
     * @var string
     */
    private $directory = __DIR__.'/../../../data';

    /**
     * @var mixed[]
     */
    private $data = [];

    public function __construct(string $directory = '')
    {
        if (!is_string($directory) || $directory === '') {
            return;
        }

        $this->directory = $directory;
    }

    public function getDirectory(): string
    {
        return $this->directory;
    }

    public static function directory(string $directory): Data
    {
        return new self($directory);
    }

    /**
     * Load the file into the memory
     *
     * @param mixed $fileName The requested filename
     *
     *
     * @throws DataException
     */
    public function load($fileName): void
    {
        $filePath = $this->getFilePath($fileName);

        // Check if there's an available loader for the provided file's extention.
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $loader = ucfirst($ext).'Loader';
        $qualifiedLoader = 'Respect\\Validation\\Helpers\\Data\\Loaders\\'.$loader;

        if (!class_exists($qualifiedLoader)) {
            throw DataException::loaderNotSupported($ext);
        }

        $loader = new $qualifiedLoader();

        $this->data = $loader->load($filePath);
    }

    /**
     * Validates the filename then returns the full path
     *
     * @param mixed $fileName The requested filename
     *
     * @return string file's full path
     *
     * @throws DataException
     */
    public function getFilePath($fileName): string
    {
        if (!is_string($fileName) || $fileName === '') {
            throw DataException::noFileProvided();
        }

        $filePath = $this->directory.DIRECTORY_SEPARATOR.$fileName;

        if (!is_file($filePath)) {
            throw DataException::fileNotFound($filePath);
        }

        return $filePath;
    }

    /**
     * Using a Dot Path notation to get a value from the file.
     *
     * @param string $path value path ( Using dot notation )
     * @param string|null $callback a function to map through the resolved value
     *
     * @return mixed the resolved value or the result of the callback
     *
     * @throws DataException
     */
    public function get(string $path, ?string $callback = null)
    {
        $explodedPath = explode('.', $path);

        $resolvedValue = $this->data;

        foreach ($explodedPath as $key) {
            if (!isset($resolvedValue[$key])) {
                throw DataException::valueNotFound($path);
            }

            $resolvedValue = $resolvedValue[$key];
        }

        return is_null($callback) ? $resolvedValue : $callback($resolvedValue);
    }
}
