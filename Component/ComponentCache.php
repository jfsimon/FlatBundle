<?php

namespace BeSimple\FlatBundle\Component;

use BeSimple\FlatBundle\Cache;

class ComponentCache extends Cache
{
    public function read($id)
    {
        return parent::readFile($this->getFilePath($id));
    }

    public function write($id, $html)
    {
        parent::writeFile($this->getFilePath($id));
    }

    protected function getFilePath($id)
    {
        return 'component' . DIRECTORY_SEPARATOR . $id;
    }
}
