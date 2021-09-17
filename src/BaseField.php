<?php

namespace Tanthammar\TallForms;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tanthammar\TallForms\Traits\HasViews;
use Tanthammar\TallForms\Traits\HasDesign;
use Tanthammar\TallForms\Traits\HasLabels;
use Tanthammar\TallForms\Traits\HasAttributes;
use Tanthammar\TallForms\Traits\HasSharedProperties;

abstract class BaseField
{
    use HasLabels, HasAttributes, HasSharedProperties, HasDesign, HasViews;

    public $label;
    public $name;
    public $key;
    public $type = 'input';
    public $rules = 'nullable';

    public $default;
    public $help;

    public $before;
    public $after;
    public $above;
    public $below;

    public $errorMsg;

    public $realtimeValidationOn = true;

    public $allowed_in_repeater = true;
    public $allowed_in_keyval = true;

    //Tabs, Groups, Panels and similar design elements that has a field array but should be ignored in form_data and validation
    public bool $ignored = false;

    public function __construct($label, $key)
    {
        $this->label = $label;
        $this->name = $key ?? Str::snake(Str::lower($label));
        $this->key = 'form_data.' . $this->name;
        $this->wire = config('tall-forms.field-attributes.wire');
        $this->setAttr();
        $this->overrides();
    }

    //problem with collect()->firstWhere()
    /*public function __get($property)
    {
        return $this->$property;
    }*/

    protected function overrides(): static|self
    {
        return $this;
    }


    public static function make(string $label, string $key = null)
    {
        return new static($label, $key);
    }

    /**
     * Standard Laravel validation syntax, default = 'nullable'
     * @param array|string $rules
     * @return $this
     */
    public function rules($rules): static|self
    {
        $this->rules = $rules;
        return $this;
    }

    public function default($default): static|self
    {
        $this->default = $default;
        return $this;
    }


    public function help(string $help): static|self
    {
        $this->help = $help;
        return $this;
    }


    /**
     * Add a custom error message displayed on field validation error
     * @param $string
     * @return $this
     */
    public function errorMsg(string $string): static|self
    {
        $this->errorMsg = $string;
        return $this;
    }

    //used by SpatieTags
    public function fieldToArray(): array
    {
        $array = array();
        foreach ($this as $key => $value) {
            $array[$key] = is_array($value) ? (array) $value : $value;
        }
        return $array;
    }

    public function before(string $text): static|self
    {
        $this->before = $text;
        return $this;
    }

    public function after(string $text): static|self
    {
        $this->after = $text;
        return $this;
    }

    public function above(string $text): static|self
    {
        $this->above = $text;
        return $this;
    }

    public function below(string $text): static|self
    {
        $this->below = $text;
        return $this;
    }

    /**
     * Consider using ->wire('wire:model.defer') instead
     * @return $this
     */
    public function realtimeValidationOff()
    {
        $this->realtimeValidationOn = false;
        return $this;
    }
}
