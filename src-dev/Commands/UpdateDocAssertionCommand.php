<?php

declare(strict_types=1);

namespace Respect\Dev\Commands;


use _PHPStan_5adafcbb8\SebastianBergmann\Diff\Differ;
use _PHPStan_5adafcbb8\SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder;
use Respect\Dev\Helpers\MarkdownProcessor;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;

use function basename;
use function dirname;
use function file_put_contents;

#[AsCommand(
    name: 'update:doc:assertions',
    description: 'Update the output assertions in the validator documentation code blocks',
)]
final class UpdateDocAssertionCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('<info>Starting validator documentation update...</info>');

        $finder = new Finder();
        $root = dirname(__DIR__, 2);
        $finder->files()->in($root . '/docs/validators')->name('*.md');

        $progressBar = new ProgressBar($output, 50);
        $progressBar->start();

        $filesUpdated = 0;
        $diff = '';
        $differ = new Differ(new UnifiedDiffOutputBuilder());

        foreach ($finder as $file) {
            $filePath = $file->getRealPath();

            $content = file_get_contents($filePath);

            $processor = MarkdownProcessor::fromContent($content);
            $processedContent = $processor->process();

            if ($content !== $processedContent) {
                file_put_contents($filePath, $processedContent);

                $diff .= '<comment>' . str_replace($root . '/', '', $filePath)  . '</comment>' . PHP_EOL;
                $diff .= $differ->diff($content, $processedContent);
                $diff .= PHP_EOL;
                $filesUpdated++;
            }

            $progressBar->advance();
        }

        $progressBar->finish();

        $output->write(PHP_EOL);
        $output->writeln('<info>Processing complete!</info>');
        $output->writeln('Files updated: ' . $filesUpdated);
        $output->writeln(preg_replace_callback(
            '/^([+-])(.*)$/m',
            function ($matches) {
                return $matches[1] === '+' ? "<fg=green>{$matches[0]}</>" : "<fg=red>{$matches[0]}</>";
            },
            $diff
        ));

        return Command::SUCCESS;
    }
}
