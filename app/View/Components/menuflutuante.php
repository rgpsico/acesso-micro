<?php

namespace App\View\Components;

use App\Models\ConfiguracaoLegado;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class menuflutuante extends Component
{
    protected $config;
    /**
     * Create a new component instance.
     */
    public function __construct(ConfiguracaoLegado $config)
    {
        $this->config = $config;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menuflutuante',[
            'config' => $this->config::all()
        ]);
    }
}
