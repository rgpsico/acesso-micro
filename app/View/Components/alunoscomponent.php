<?php

namespace App\View\Components;

use App\Models\Aluno;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class alunoscomponent extends Component
{
    protected $model;
    /**
     * Create a new component instance.
     */
    public function __construct(aluno $model)
    {
        $this->model = $model;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $model = $this->model::all();

        return view('components.alunoscomponent', compact('model'));
    }
}
