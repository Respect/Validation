<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\CodeGen;

use DirectoryIterator;
use Nette\PhpGenerator\PhpNamespace;
use Nette\PhpGenerator\Printer;
use ReflectionClass;
use ReflectionParameter;
use Respect\Dev\CodeGen\Attributes\Mixin;

use function file_get_contents;
use function in_array;
use function is_file;
use function is_readable;
use function ksort;
use function sprintf;

final class MixinGenerator
{
    /** @param array<InterfaceConfig> $interfaces */
    public function __construct(
        private readonly string $sourceDir,
        private readonly string $sourceNamespace,
        private readonly string $outputDir,
        private readonly string $outputNamespace,
        private readonly array $interfaces,
        private readonly MethodBuilder $methodBuilder = new MethodBuilder(),
        private readonly OutputFormatter $outputFormatter = new OutputFormatter(),
    ) {
    }

    /** @return array<string, string> filename => content */
    public function generate(): array
    {
        $validators = $this->scanValidators();
        $prefixes = $this->discoverPrefixes($validators);
        $filters = $this->discoverFilters($validators);

        $files = [];

        foreach ($this->interfaces as $interfaceConfig) {
            $prefixInterfaceNames = [];

            foreach ($prefixes as $prefix) {
                $interfaceName = $prefix['name'] . $interfaceConfig->suffix;
                $prefixInterfaceNames[] = $this->outputNamespace . '\\' . $interfaceName;

                $this->generateInterface(
                    $interfaceName,
                    $interfaceConfig,
                    $validators,
                    $filters,
                    $prefix,
                    $files,
                );
            }

            $this->generateRootInterface(
                $interfaceConfig,
                $prefixInterfaceNames,
                $validators,
                $filters,
                $files,
            );
        }

        return $files;
    }

    /** @return array<string, ReflectionClass> */
    private function scanValidators(): array
    {
        $validators = [];

        foreach (new DirectoryIterator($this->sourceDir) as $file) {
            if (!$file->isFile()) {
                continue;
            }

            $className = $this->sourceNamespace . '\\' . $file->getBasename('.php');
            $reflection = new ReflectionClass($className);

            if ($reflection->isAbstract()) {
                continue;
            }

            $validators[$reflection->getShortName()] = $reflection;
        }

        ksort($validators);

        return $validators;
    }

    /**
     * @param array<string, ReflectionClass> $validators
     *
     * @return array<array{name: string, prefix: string, requireInclusion: bool, prefixParameter: ?ReflectionParameter}>
     */
    private function discoverPrefixes(array $validators): array
    {
        $prefixes = [];

        foreach ($validators as $reflection) {
            $attributes = $reflection->getAttributes(Mixin::class);
            if ($attributes === []) {
                continue;
            }

            $mixin = $attributes[0]->newInstance();
            if ($mixin->prefix === null) {
                continue;
            }

            $prefixParameter = null;
            if ($mixin->prefixParameter) {
                $constructor = $reflection->getConstructor();
                if ($constructor !== null) {
                    $params = $constructor->getParameters();
                    if ($params !== []) {
                        $prefixParameter = $params[0];
                    }
                }
            }

            $prefixes[$mixin->prefix] = [
                'name' => $reflection->getShortName(),
                'prefix' => $mixin->prefix,
                'requireInclusion' => $mixin->requireInclusion,
                'prefixParameter' => $prefixParameter,
            ];
        }

        ksort($prefixes);

        return $prefixes;
    }

    /**
     * @param array<string, ReflectionClass> $validators
     *
     * @return array<string, Mixin>
     */
    private function discoverFilters(array $validators): array
    {
        $filters = [];

        foreach ($validators as $name => $reflection) {
            $attributes = $reflection->getAttributes(Mixin::class);
            if ($attributes === []) {
                continue;
            }

            $filters[$name] = $attributes[0]->newInstance();
        }

        return $filters;
    }

    /**
     * @param array<string, ReflectionClass> $validators
     * @param array<string, Mixin> $filters
     * @param array{name: string, prefix: string, requireInclusion: bool, prefixParameter: ?ReflectionParameter} $prefix
     * @param array<string, string> $files
     */
    private function generateInterface(
        string $interfaceName,
        InterfaceConfig $config,
        array $validators,
        array $filters,
        array $prefix,
        array &$files,
    ): void {
        $namespace = new PhpNamespace($this->outputNamespace);
        $interface = $namespace->addInterface($interfaceName);

        foreach ($validators as $name => $reflection) {
            $mixin = $filters[$name] ?? null;

            if ($prefix['requireInclusion']) {
                if ($mixin === null || !in_array($prefix['prefix'], $mixin->include, true)) {
                    continue;
                }
            } elseif ($mixin !== null && in_array($prefix['prefix'], $mixin->exclude, true)) {
                continue;
            }

            $method = $this->methodBuilder->build(
                $namespace,
                $reflection,
                $config->returnType,
                $prefix['prefix'],
                $config->static,
                $prefix['prefixParameter'],
            );

            $interface->addMember($method);
        }

        $this->addFile($interfaceName, $namespace, $files);
    }

    /**
     * @param array<string> $prefixInterfaceNames
     * @param array<string, ReflectionClass> $validators
     * @param array<string, Mixin> $filters
     * @param array<string, string> $files
     */
    private function generateRootInterface(
        InterfaceConfig $config,
        array $prefixInterfaceNames,
        array $validators,
        array $filters,
        array &$files,
    ): void {
        $interfaceName = $config->suffix;
        $namespace = new PhpNamespace($this->outputNamespace);
        $interface = $namespace->addInterface($interfaceName);

        foreach ($config->rootExtends as $extend) {
            $interface->addExtend($extend);
        }

        foreach ($prefixInterfaceNames as $prefixInterface) {
            $interface->addExtend($prefixInterface);
        }

        if ($config->rootComment !== null) {
            $interface->addComment($config->rootComment);
        }

        foreach ($config->rootUses as $use) {
            $namespace->addUse($use);
        }

        foreach ($validators as $reflection) {
            $method = $this->methodBuilder->build(
                $namespace,
                $reflection,
                $config->returnType,
                null,
                $config->static,
            );

            $interface->addMember($method);
        }

        $this->addFile($interfaceName, $namespace, $files);
    }

    /** @param array<string, string> $files */
    private function addFile(string $interfaceName, PhpNamespace $namespace, array &$files): void
    {
        $printer = new Printer();
        $printer->wrapLength = 300;

        $filename = sprintf('%s/%s.php', $this->outputDir, $interfaceName);
        $existingContent = '';
        if (is_file($filename) && is_readable($filename)) {
            $existingContent = file_get_contents($filename) ?: '';
        }

        $formattedContent = $this->outputFormatter->format(
            $printer->printNamespace($namespace),
            $existingContent,
        );

        $files[$filename] = $formattedContent;
    }
}
