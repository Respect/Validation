<?php

chdir(__DIR__);
date_default_timezone_set('UTC');

$package_xml_file = '../package.xml';

if (!file_exists($package_xml_file))
    die("package.xml does not exists");

$package_data = simplexml_load_file($package_xml_file);
$project_name = $package_data->name;
$phar_name = "$project_name.phar";

$phar = new Phar("../$phar_name", 0, $phar_name);

foreach ($package_data->contents->dir->file as $file)
    $phar->addFile(realpath("../{$file['name']}"));

$phar->addFromString("autoload.php", <<<'LOADER'
<?php
    spl_autoload_register(function($className)
    {
        $fileParts = explode('\\', ltrim($className, '\\'));

        if (false !== strpos(end($fileParts), '_'))
            array_splice($fileParts, -1, 1, explode('_', current($fileParts)));

        $fileName = implode(DIRECTORY_SEPARATOR, $fileParts) . '.php';
        
        if (stream_resolve_include_path($fileName))
            require $fileName;
    });

LOADER
);

$phar->setStub("<?php Phar::mapPhar('$phar_name'); include 'phar://$phar_name/autoload.php'; __HALT_COMPILER();");