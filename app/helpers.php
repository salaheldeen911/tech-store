<?php
if (!function_exists('isActive')) { //validate if the function exists
    function isActive($user)
    {
        // dd($user->expire_at > now() ? true : false);
        return $user->expire_at > now() ? true : false;
    }
}

if (!function_exists('can')) { //validate if the function exists
    function can($id)
    {
        // dd($user->expire_at > now() ? true : false);
        return auth()->user()->id == $id || auth()->user()->hasRole("super_admin") ? true : false;
    }
}
