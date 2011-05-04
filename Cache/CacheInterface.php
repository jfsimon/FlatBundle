<?php

namespace BeSimple\FlatBundle\Cache;

interface CacheInterface
{
    public function hasItem($type, $viewId, $itemId);

    public function getItem($type, $viewId, $itemId);

    public function setItem($type, $viewId, $itemId, $content);

    public function hasView($id);

    public function getView($id);

    public function setView($id, $content);
}
