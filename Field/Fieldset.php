<?php

namespace BeSimple\FlatBundle\Field;

abstract class Fieldset extends Field
{
    protected $fields;
    protected $order;

    /**
     * Constructor.
     *
     * @see Field
     */
    public function __construct(array $options = array(), array $context = array())
    {
        parent::__construct($options, $context);
        $this->fields = array();
        $this->order = array();
    }

    /**
     * @see FieldsetInterface
     */
    public function all()
    {
        $this->reorder();
        return $this->fields;
    }

    /**
     * Return a field.
     *
     * @param  string     $name Field name
     * @return Field|null Named field
     */
    public function get($name)
    {
        return isset($this->fields[$name]) ? $this->fields[$name] : null;
    }

    /**
     * @see FieldsetInterface
     */
    public function add($name, FieldInterface $field)
    {
        $this->fields[$name] = $field;
    }

    /**
     * Remove a field.
     *
     * @param string $name Field name
     */
    public function remove($name)
    {
        unset($this->fields[$name]);
    }

    /**
     * @see FieldsetInterface
     */
    public function sort(array $order)
    {
        $this->order = $order;
    }

    /**
     * @return int Fields count
     */
    public function count()
    {
        return count($this->fields);
    }

    /**
     * @return array Ordered fields list
     */
    public function getIterator()
    {
        $this->reorder();
        return new \ArrayIterator($this->fields);
    }

    /**
     * Reorder fields.
     */
    protected function reorder()
    {
        $fields = array();

        foreach ($this->order as $name) {
            if (isset($this->fields[$name])) {
                $fields[$name] = $this->fields[$name];
                unset($this->fields[$name]);
            }
        }

        foreach ($this->fields as $name => $field) {
            $fields[$name] = $this->fields[$name];
        }

        $this->fields = $fields;
    }
}
