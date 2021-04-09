<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Seo;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Relation;
use Tipoff\Support\Contracts\Models\BaseModelInterface;

interface KeywordInterface extends BaseModelInterface
{
    /**
     * Check if type is Branded.
     *
     * @return bool
     */
    public function isBranded(): bool;

    /**
     * Check if type is Generic.
     *
     * @return bool
     */

    public function isGeneric(): bool;

    /**
     * Check if type is Local.
     *
     * @return bool
     */

    public function isLocal(): bool;

    /**
     * Set keyword as active.
     *
     * @return self
     */
    public function setActive(): self;

    /**
     * Get ranking for keyword.
     *
     * @return void
     */
    public function getRanking(): void;

    /**
     * Get search locales.
     *
     * @return Relation
     */
    public function searchLocales(): Relation;

    /**
     * Relation with parent keyword.
     *
     * @return Relation
     */
    public function parent(): Relation;
}
