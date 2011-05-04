<?php

namespace BeSimple\FlatBundle\Component;

use Symfony\Component\HttpKernel\Kernel;
use BeSimple\FlatBundle\Model\ComponentManagerInterface;

class ComponentManager
{
    private $kernel;
    private $persister;
    private $cache;
    private $defaultNamespace;
    private $components;

    public function __construct(Kernel $kernel, ComponentManagerInterface $persister, ComponentCache $cache, $defaultNamespace)
    {
        $this->kernel = $kernel;
        $this->persister = $persister;
        $this->cache = $cache;
        $this->defaultNamespace = $defaultNamespace;
        $this->components = array();
    }

    public function get($id)
    {
        if (!iseet($this->components[$id])) {
            $this->components[$id] = $this->persister->findOne($id);
        }

        return $this->components[$id];
    }

    public function set($id, ComponentInterface $component)
    {
        $this->persister->save($id, $component);
        $this->cache->write($id, $component->render());

        $this->components[$id] = $component;
    }

    public function remove($id)
    {
        $this->persister->remove($id);

        unset($this->components[$id]);
    }

    public function bind($id, array $data)
    {
        $component = $this->get($id);
        $component->setData($data);

        $this->set($id, $component);
    }

    public function render($id)
    {
        $html = $this->cache->read($id);

        if ($html) {
            return $html;
        }

        return $this->get($id)->render();
    }

    protected function create($type, array $options = array(), array $context = array())
    {
        $class = $this->getClassName($type);

        return new $class($options, $context);
    }

    protected function getClassName($type)
    {
        $parts = explode(':', $type);

        if (1 === count($parts)) {
            return $type;
        }

        if (3 === count($parts)) {
            $class = get_class($this->kernel->getBundle($parts[0]));
            $class .= sprintf('\\%s\\%sComponent', $this->defaultNamespace, $parts[2]);
        }

        throw new \InvalidArgumentException(sprintf('"%s" is not a valid resource name'));
    }
}
