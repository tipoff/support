<?php

declare(strict_types=1);

namespace Tipoff\Support\Contracts\Models;

use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

interface UserInterface extends AuthenticatableContract, AuthorizableContract, BaseModelInterface
{
    public function hasRole($roles, string $guard = null): bool;

    public function hasPermissionTo($permission, $guardName = null): bool;

    /**
     * (From Laravel/Cashier) Make a "one off" charge on the customer for the given amount.
     *
     * @param  int  $amount
     * @param  string  $paymentMethod
     * @param  array  $options
     * @return \Laravel\Cashier\Payment
     */
    public function charge($amount, $paymentMethod, array $options = []);
}
