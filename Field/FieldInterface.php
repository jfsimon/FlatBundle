<?php

namespace BeSimple\FlatBundle\Field;

interface FieldInterface
{
    /**
     * Set options.
     *
     * @param array $options Options
     */
    public function setOptions(array $options);

    /**
     * Set data from form.
     *
     * @param array $data The form field data
     */
    public function setData(array $data);

    /**
     * Return admin form field.
     *
     * @param Form $form
     */
    public function getFormField();

    /**
     * Return field context for rendering.
     *
     * @return array Templating context
     */
    public function getContext();
}