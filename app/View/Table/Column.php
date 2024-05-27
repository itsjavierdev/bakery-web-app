<?php

namespace App\View\Table;

class Column
{
    //default component
    public string $component = 'admin.atoms.table.columns.default';

    //column key
    public string $key;

    //column label
    public string $label;

    //column default
    public bool $default = false;

    public function __construct($key, $label, $default = false)
    {
        $this->key = $key;
        $this->label = $label;
        $this->default = $default;
    }

    public static function make($key, $label, $default = false)
    {
        return new static($key, $label, $default);
    }
    public function component($component)
    {
        $this->component = $component;

        return $this;
    }
    public function isDefault()
    {
        $this->default = true;
        return $this;
    }
}
