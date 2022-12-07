<?php

namespace Rmx;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class Storage
{
    public static function removeEmptyDirectories(String $path): void
    {
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST) as $file) {
            $pathname = $file->getPathname();

            if (
                $file->isDir()
                && mb_substr($pathname, -1) !== '.'
                && self::isDirEmpty($pathname)
            ) {
                rmdir($pathname);
            }
        }
    }

    public static function isDirEmpty(String $dir): bool
    {
        return !(new FilesystemIterator($dir))->valid();
    }
}
