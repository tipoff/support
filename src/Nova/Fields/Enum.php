<?php

declare(strict_types=1);

namespace Tipoff\Support\Nova\Fields;

use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class Enum extends Select
{
    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->resolveUsing(
            function ($value) {
                return $value instanceof \MabeEnum\Enum ? $value->getValue() : $value;
            }
        );

        $this->displayUsing(
            function ($value) {
                return $value instanceof \MabeEnum\Enum ? $value->getValue() : $value;
            }
        );

        $this->fillUsing(
            function (NovaRequest $request, $model, $attribute, $requestAttribute) {
                if ($request->exists($requestAttribute)) {
                    $model->{$attribute} = $request[$requestAttribute];
                }
            }
        );
    }

    public function attach($class)
    {
        $options = [];
        foreach (call_user_func([$class, 'getValues']) as $value) {
            $options[Nova::humanize($value)] = $value;
        }

        return $this->options($options)
            ->rules(new \Tipoff\Support\Rules\Enum($class));
    }
}
