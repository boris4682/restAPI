<?php
spl_autoload_register(function ($className) {
$array_paths = array(
'Controllers/',
'lib/',
''
);

foreach ($array_paths as $path) {
$className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
$path = $className . '.php';
$filePath = array_shift($array_paths) . $path;

if (is_file($filePath)) {
include_once $filePath;
}
}
});