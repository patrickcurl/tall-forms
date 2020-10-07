<?php


namespace Tanthammar\TallForms\Components;

use Illuminate\View\View;
use Illuminate\View\Component;
use Tanthammar\TallForms\Search as Field;
use Tanthammar\TallForms\Traits\Helpers;

class Search extends Component
{
    use Helpers;

    public Field $field;
    public string $temp_key;
    public array $options;

    public function __construct(Field $field, string $tempKey, array $options = [])
    {
        $this->field = $field;
        $this->temp_key = $tempKey;
        $this->options = $options;
    }

    public function render(): View
    {
        return view('tall-forms::components.search');
    }
}
