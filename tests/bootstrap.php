<?php /** a Courtesy of Respect/Foundation */

date_default_timezone_set('UTC');

$paths = explode(PATH_SEPARATOR,get_include_path());
$paths[] = trim(`pear config-get php_dir`);

// See if composer is present then it should be picked up too
if (file_exists(dirname(__DIR__).'/vendor/composer')) {
    $map = require dirname(__DIR__).'/vendor/composer/autoload_namespaces.php';
    foreach ($map as $path)
        $paths = array_merge($paths, $path);
}

natsort($paths);
array_unshift($paths, dirname(__DIR__) .'/library');
set_include_path(implode(PATH_SEPARATOR, array_unique($paths)));

/** Autoloader that implements the PSR-0 spec for interoperability between PHP software. */
spl_autoload_register(
    function($className) {
        static $composerClassmap;
        if (!isset($composerClassmap) && file_exists(dirname(__DIR__).'/vendor/composer'))
               $composerClassmap = require dirname(__DIR__).'/vendor/composer/autoload_classmap.php';
        // Also consider composer classMap of course
        if (isset($composerClassmap[$className]))
            return require $composerClassmap[$className];

        $fileParts = explode('\\', ltrim($className, '\\'));

        if (false !== strpos(end($fileParts), '_'))
            array_splice($fileParts, -1, 1, explode('_', current($fileParts)));

        $file = implode(DIRECTORY_SEPARATOR, $fileParts) . '.php';

        foreach (explode(PATH_SEPARATOR, get_include_path()) as $path) {
            if (file_exists($path = $path . DIRECTORY_SEPARATOR . $file))
                return require $path;
        }
    }
);
