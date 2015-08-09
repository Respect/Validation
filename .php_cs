<?php

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->files()
    ->name('*.php')
    ->name('*.phpt')
    ->in('library')
    ->in('tests');

return Symfony\CS\Config\Config::create()
    ->level(\Symfony\CS\FixerInterface::PSR2_LEVEL)
    ->fixers(array(
        // All items of the @param, @throws, @return, @var, and @type phpdoc
        // tags must be aligned vertically.
        'phpdoc_params',
        // Convert double quotes to single quotes for simple strings.
        'single_quote',
        // Group and seperate @phpdocs with empty lines.
        'phpdoc_separation',
        // An empty line feed should precede a return statement.
        'return',
        // Remove trailing whitespace at the end of blank lines.
        'whitespacy_lines',
        // Removes extra empty lines.
        'extra_empty_lines',
        // Unused use statements must be removed.
        'unused_use'
    ))
    ->finder($finder);
