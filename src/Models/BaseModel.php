<?php

declare(strict_types=1);

namespace Tipoff\Support\Models;

use Assert\Assert;
use Illuminate\Database\Eloquent\Model;
use Tipoff\Support\Contracts\Models\BaseModelInterface;

class BaseModel extends Model implements BaseModelInterface
{
    protected $guarded = ['id'];
    /**
     * @inheritDoc
     */
    public function belongsTo($related, $foreignKey = null, $ownerKey = null, $relation = null)
    {
        if (is_string($related)) {
            Assert::that($related)->classExists();
        }

        return parent::belongsTo($related, $foreignKey, $ownerKey, $relation);
    }

    /**
     * @inheritDoc
     * @psalm-suppress UnusedVariable
     */
    protected function guessBelongsToRelation()
    {
        // Account for extra stack frame!
        [$one, $two, $three, $caller] = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 4);

        return $caller['function'];
    }

    /**
     * @inheritDoc
     */
    public function hasMany($related, $foreignKey = null, $localKey = null)
    {
        if (is_string($related)) {
            Assert::that($related)->classExists();
        }

        return parent::hasMany($related, $foreignKey, $localKey);
    }

    public static function find($id)
    {
        return static::find($id);
    }

    public static function findOrFail($id)
    {
        return static::findOrFail($id);
    }

    public function getId()
    {
        return $this->id;
    }
}
