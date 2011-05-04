<?php

namespace BeSimple\FlatBundle\Field;

use Symfony\Component\Form\FieldInterface as FormFieldInterface;

abstract class Field
{
    protected $data;
    protected $options;
    protected $context;

    /**
     * Contructor.
     *
     * @param array $options Options
     * @param array $context Extra context
     */
    public function __construct(array $options = array(), array $context = array())
    {
        $this->data = array();
        $this->options = $options;
        $this->context = array();
    }

    /**
     * Get the form field.
     *
     * @return FormFieldInterface The form field
     */
    public function getFormField()
    {
        return $this->createFormField();
    }

    /**
     * Get templating context.
     *
     * @return array Context
     */
    public function getContext()
    {
        return array_merge($this->context, $this->createContext());
    }

    /**
     * Add extra context.
     *
     * @param array $context Extra context
     */
    public function addContext(array $context)
    {
        $this->context = array_merge($this->context, $context);
    }

    /**
     * Get bound data.
     *
     * @return array Bound data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Bind data.
     *
     * @param array $data Data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * Get options.
     *
     * @return array Options
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @see FieldInterface
     */
    public function setOptions(array $options)
    {
        $this->options = $options;
    }

    /**
     * Merge given options with current.
     *
     * @param array $options Options
     */
    public function addOptions(array $options)
    {
        $this->options = array_merge($this->options, $options);
    }

    /**
     * Get an option.
     *
     * @param string $key Option name
     */
    public function getOption($name)
    {
        return $this->options[$name];
    }

    /**
     * Set an option.
     *
     * @param string $name  Option name
     * @param mixed  $value Option value
     */
    public function setOption($name, $value)
    {
        $this->options[$name] = $value;
    }

    /**
     * Create the form field.
     *
     * @return FormFieldInterface
     */
    abstract protected function createFormField()
    {
    }

    /**
     * Create the context.
     *
     * @return array Computed context
     */
    abstract protected function createContext()
    {
    }
}
