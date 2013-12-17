<?php

$src        = $argv[1];
$vendorRoot = $argv[2];
$buildRoot  = $argv[3];
$entryPoint = $argv[4];

$phar = new Phar($buildRoot . "/core-app.phar", FilesystemIterator::CURRENT_AS_FILEINFO | FilesystemIterator::KEY_AS_FILENAME, "core-app.phar");

$phar->buildFromDirectory($vendorRoot, '/.php$/');
$phar->buildFromDirectory($srcRoot,    '/.php|.html|.tpl$/');

// Add app entry point
$phar[$entryPoint] = file_get_contents($srcRoot."/".$entryPoint);
$phar->setStub($phar->createDefaultStub($entryPoint));
 
$phar->compressFiles(Phar::GZ);