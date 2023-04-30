<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DashboardControllerPolicy
{

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function viewAdminDashboard(?User $user) {
        if($user && $user->role_id == 3) {
            return Response::allow('Добро пожаловать, администратор!');
        }
        return Response::deny('Недостаточно прав для просмотра данной страницы.');
    }

}
