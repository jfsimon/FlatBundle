<?php

namespace BeSimple\FlatBundle\Model;

abstract class Component
{
    protected $view;
    protected $stack;
    protected $options;
    protected $context;
    protected $template;
    protected $data;
}