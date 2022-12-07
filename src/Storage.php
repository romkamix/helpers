<?php

namespace Rmx;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Storage
{
    public static function removeEmptyDirectories(String $path): void
    {
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST) as $file) {
            $path = $file->getPathname();

            if (
                $file->isDir()
                && mb_substr($path, -1) !== '.'
                && self::isDirEmpty($path)
            ) {
                rmdir($path);
            }
        }
    }

    public static function isDirEmpty(String $dir): bool
    {
        return !(new \FilesystemIterator($dir))->valid();
    }
}
