<?php


namespace Tanthammar\TallForms;

class Checkbox extends BaseField
{
    public $placeholder;

    protected function overrides(): self
    {
        $this->type = 'checkbox';
        return $this;
    }

    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function inputAttr(array $attributes): static
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }
}