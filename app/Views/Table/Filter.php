<?php

namespace App\Views\Table;

class Filter
{

    //column key
    public string $key;

    //column label
    public string $label;

    //if the column is date with accesor isoFormat('DD MMM YYYY')
    public bool $isDate = false;

    public function __construct($key, $label, $isDate = false)
    {
        $this->key = $key;
        $this->label = $label;
        $this->isDate = $isDate;
    }

    public static function make($key, $label, $isDate = false)
    {
        return new static($key, $label, $isDate);
    }
    public function component($component)
    {
        $this->component = $component;

        return $this;
    }
    public function date()
    {
        $this->isDate = true;
        return $this;
    }
}
