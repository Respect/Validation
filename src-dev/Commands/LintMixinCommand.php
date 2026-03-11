<?php

/*
 * SPDX-License-Identifier: MIT
 * SPDX-FileCopyrightText: (c) Respect Project Contributors
 * SPDX-FileContributor: Alexandre Gomes Gaigalas <alganet@gmail.com>
 * SPDX-FileContributor: Henrique Moody <henriquemoody@gmail.com>
 */

declare(strict_types=1);

namespace Respect\Dev\Commands;

use Respect\Dev\CodeGen\Config;
use Respect\Dev\CodeGen\FluentBuilder\MethodBuilder;
use Respect\Dev\CodeGen\FluentBuilder\MixinGenerator;
use Respect\Dev\CodeGen\FluentBuilder\PrefixMapGenerator;
use Respect\Dev\CodeGen\InterfaceConfig;
use Respect\Dev\Differ\ConsoleDiffer;
use Respect\Dev\Differ\Item;
use Respect\Validation\Mixins\Chain;
use Respect\Validation\Validator;
use Respect\Validation\ValidatorBuilder;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use function count;
use function dirname;
use function file_get_contents;
use function file_put_contents;
use function is_file;
use function is_readable;
use function sprintf;

#[AsCommand(
    name: 'lint:mixin',
    description: 'Apply linters to the generated mixin interfaces',
)]
final class LintMixinCommand extends Command
{
    public function __construct(
        private readonly ConsoleDiffer $differ,
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption(
            'fix',
            null,
            null,
            'Automatically fix files with issues.',
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $srcDir = dirname(__DIR__, 2) . '/src';

        $config = new Config(
            sourceDir: $srcDir . '/Validators',
            sourceNamespace: 'Respect\\Validation\\Validators',
            outputDir: $srcDir . '/Mixins',
            outputNamespace: 'Respect\\Validation\\Mixins',
        );

        $generator = new MixinGenerator(
            config: $config,
            methodBuilder: new MethodBuilder(
                excludedTypePrefixes: ['Sokil', 'Egulias'],
                excludedTypeNames: ['finfo'],
            ),
            interfaces: [
                new InterfaceConfig(
                    suffix: 'Builder',
                    returnType: Chain::class,
                    static: true,
                ),
                new InterfaceConfig(
                    suffix: 'Chain',
                    returnType: Chain::class,
                    rootExtends: [Validator::class],
                    rootComment: '@mixin ValidatorBuilder',
                    rootUses: [ValidatorBuilder::class],
                ),
            ],
        );

        $prefixMapGenerator = new PrefixMapGenerator(
            config: $config,
            outputClassName: 'PrefixMap',
        );

        $files = $generator->generate() + $prefixMapGenerator->generate();

        $updatableFiles = [];
        foreach ($files as $filename => $content) {
            $existingContent = '';
            if (is_file($filename) && is_readable($filename)) {
                $existingContent = file_get_contents($filename) ?: '';
            }

            if ($content === $existingContent) {
                continue;
            }

            $updatableFiles[$filename] = $content;
            $output->writeln($this->differ->diff(
                new Item($filename, $existingContent),
                new Item($filename, $content),
            ));
        }

        if ($updatableFiles === []) {
            $output->writeln('<info>No changes needed.</info>');
        } else {
            $output->writeln(sprintf('<comment>Changes needed in %d files.</comment>', count($updatableFiles)));
        }

        if ($updatableFiles !== [] && !$input->getOption('fix')) {
            return Command::FAILURE;
        }

        foreach ($updatableFiles as $filename => $content) {
            file_put_contents($filename, $content);
        }

        return Command::SUCCESS;
    }
}
