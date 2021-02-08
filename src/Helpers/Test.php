<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;

if (! function_exists('randomOrCreate')) {
    /**
     * Get random model or create model using factory.
     *
     * @param  string|Model $classNameOrModel
     * @return Model
     */
    function randomOrCreate($classNameOrModel): Model
    {
        if (is_string($classNameOrModel)) {
            $className = $classNameOrModel;
        }

        if ($classNameOrModel instanceof Model) {
            $className = class_basename($classNameOrModel);
        }

        if ($className::count() > 0) {
            return $className::all()->random();
        }

        return $className::factory()->create();
    }
}

if (! function_exists('createModelStub')) {
    /**
     * Dynamically defines a model class on the fly if not already defined.  Useful
     * for creating stub models and there tables to satisfy possible FK dependencies.
     *
     * @param string $class
     */
    function createModelStub(string $class): void
    {
        if (class_exists($class)) {
            return;
        }

        $classBasename = class_basename($class);
        $classNamespace = substr($class, 0, strrpos($class, '\\'));

        $classDef = <<<EOT
namespace {$classNamespace};

use Illuminate\Database\Eloquent\Model;
use Tipoff\Support\Models\TestModelStub;

class {$classBasename} extends Model {
    use TestModelStub;

    protected \$guarded = [
        'id',
    ];
};
EOT;
        // alias the anonymous class with your class name
        eval($classDef);
    }
}
