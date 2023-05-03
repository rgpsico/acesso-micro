<?php

namespace App\View\Components;

use App\Models\Justificativa;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class justificativacomponent extends Component
{
    protected $model;
    /**
     * Create a new component instance.
     */
    public function __construct(Justificativa $model)
    {
        $this->model = $model;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $model = $this->model::all();
        return view('components.justificativacomponent',[
            'model' => $model
        ]);
    }
}
