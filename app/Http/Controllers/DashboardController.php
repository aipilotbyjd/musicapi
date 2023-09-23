<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function getAllRoles()
    {
    }

    public function getAllUsersWithRoles()
    {
        $user = User::with('roles')->find(1); // Replace 1 with the user's ID
        $roleIds = $user->roles->pluck('id')->toArray();

        return response()->json($roleIds);
    }
}
