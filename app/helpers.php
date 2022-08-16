<?php

/**
 * Used to get logged-in user
 */
if ( !function_exists('loggedInUser') ) {
    function loggedInUser()
    : ?\Illuminate\Contracts\Auth\Authenticatable
    {
        return auth()->user();
    }
}

/**
 * Used to get system settings details
 */
if ( !function_exists('getSystemSettings') ) {
    function getSystemSettings($id)
    : \App\Models\SystemSetting
    {
        return \App\Models\SystemSetting::find($id);
    }
}

function isAdmin() : mixed
{
    $user = loggedInUser();
    return $user->roles->where('id', '=', config('global.role.admin'))->first();
}
