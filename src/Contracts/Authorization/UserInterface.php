<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Authorization;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

interface UserInterface extends AuthenticatableContract, AuthorizableContract
{
    public function hasRole($roles, string $guard = null): bool;

    public function hasPermissionTo($permission, $guardName = null): bool;
}
