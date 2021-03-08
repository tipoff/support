<?php

declare(strict_types=1);

namespace Tipoff\Support\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Nova;

class EnumFilter extends Filter
{
    protected string $column;

    protected string $class;

    public function __construct(string $column, string $class)
    {
        $this->column = $column;
        $this->class = $class;
    }

    public function name()
    {
        return $this->name ?: Nova::humanize($this->column);
    }

    public function apply(Request $request, $query, $value)
    {
        return $query->where($this->column, $value);
    }

    public function options(Request $request)
    {
        $options = [];
        foreach (call_user_func([$this->class, 'getValues']) as $value) {
            $options[Nova::humanize($value)] = $value;
        }

        return $options;
    }
}
