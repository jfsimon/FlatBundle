<?php

namespace BeSimple\FlatBundle\Component;

interface ConponentInterface
{
    public function setOptions();

    public function setData();

    public function getForm();

    public function render();
}
