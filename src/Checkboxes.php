<?php


namespace Tanthammar\TallForms;

use Tanthammar\TallForms\Traits\HasOptions;

class Checkboxes extends BaseField
{
    use HasOptions;

    protected function overrides(): self
    {
        $this->type = 'checkboxes';
        $this->align_label_top = true;
        $this->allowed_in_repeater = false;
        return $this;
    }

    public function inputAttr(array $attributes): static
    {
        $this->attributes['input'] = $attributes;
        return $this;
    }
}