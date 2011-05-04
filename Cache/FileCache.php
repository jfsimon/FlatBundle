<?php

namespace BeSimple\FlatBundle\Cache;

class FileCache implements CacheInterface
{
    private $directory;

    public function __construct($root, $direcory)
    {
        $this->directory = $directory . DIRECTORY_SEPARATOR . $direcory;
    }

    public function has($path)
    {
        return file_exists($this->getPath($path));
    }

    public function read($path)
    {
        $path = $this->getPath($path);

        if (!is_file($path)) {
            throw new \RuntimeErrorException(sprintf('"%s" is not a file', $path));
        }

        if (!is_readable($path)) {
            throw new \RuntimeErrorException(sprintf('File "%s" is not readable', $path));
        }

        $content = file_get_contents($path);

        if (!$content) {
            throw new \RuntimeErrorException(sprintf('Could not read "%s" file', $path));
        }

        return $content;
    }

    public function write($path, $content)
    {
        $filePath = $this->cacheDir . DIRECTORY_SEPARATOR . $filePath;
        $path = $this->getPath($path);
        $dir = dirname($path);

        if (file_exists($dir)) {
            if (!is_dir($dir)) {
                throw new \RuntimeErrorException(sprintf('"%s" is not a directory', $dir));
            }
        } else {
            if (!mkdir($dir, 0777, true)) {
                throw new \RuntimeErrorException(sprintf('Could not create "%s" directory', $dir));
            }
        }

        if (!is_writable($dir)) {
            throw new \RuntimeErrorException(sprintf('"%s" directory is not writeable', $dir));
        }

        if (!file_put_contents($path, $content)) {
            throw new \RuntimeErrorException(sprintf('Could not write "%s" file', $path));
        }
    }

    private function getPath($path)
    {
        return $this->directory . DIRECTORY_SEPARATOR . $path;
    }
}
