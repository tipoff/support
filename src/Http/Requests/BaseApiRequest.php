<?php

declare(strict_types=1);

namespace Tipoff\Support\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class BaseApiRequest extends FormRequest
{
    // Default page size in API pagination.
    const PAGE_SIZE = 20;

    /**
     * Cached model.
     *
     * @var object
     */
    protected $model;

    /**
     * Get model related with request basing on children getModelClass method.
     *
     * If possible resolve it.
     *
     * @return object
     */
    public function getModel()
    {
        if (empty($this->model)) {
            $model = app($this->getModelClass());

            $parameter = $this
                ->route()
                ->parameter(
                    Str::singular($model->getTable())
                );
            if (is_object($parameter) && $this->getModelClass() == get_class($parameter)) {
                $model = $parameter;
            }
            $this->model = $model;
        }

        return $this->model;
    }

    /**
     * Get base name of model class.
     *
     * @return string
     */
    public function getModelClassBasename()
    {
        $baseName = class_basename($this->getModelClass());

        return strtolower($baseName);
    }

    /**
     * Get fillable fields of model.
     *
     * @return array
     */
    public function getFillable()
    {
        return $this->getModel()->getFillable();
    }

    /**
     * Check if user is authorized to perform action.
     *
     * @param string $action
     * @return bool
     */
    public function authorizeAction($action)
    {
        $user = $this->user();
        $policy = Gate::getPolicyFor($this->getModel());

        switch ($action) {
            case 'viewAny':
            case 'create':
                return $user->can($action, $this->getModel());
            default:
                return $user->can($action, $this->getModel());
        }
    }

    /**
     * Get pagination size.
     *
     * @return int
     */
    public function getPageSize()
    {
        if ($this->has('page.size')) {
            return $this->input('page.size');
        }

        return self::PAGE_SIZE;
    }
}
