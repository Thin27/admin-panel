<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmployeeForm extends Component
{
    public $employeeData;
    public $factoryOptions;
    /**
     * Create a new component instance.
     */
    public function __construct($factoryOptions, $employeeData = null)
    {
        $this->employeeData = $employeeData;
        $this->factoryOptions = $factoryOptions;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.employee-form');
    }
}
