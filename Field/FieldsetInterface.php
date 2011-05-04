<?php

namespace BeSimple\FlatBundle\Field;

interface FieldsetInterface extends Field, \Traversable, \Countable
{
    /**
     * Add a field.
     *
     * @param string         $name  Name of the field
     * @param FieldInterface $field Field
     */
    public function add($name, FieldInterface $field);

    /**
     * Sort the fields
     *
     * @param array $order Ordered list of field names
     */
    public function sort(array $order);

    /**
     * Return all fields.
     *
     * @return array All fields
     */
    public function all();
}