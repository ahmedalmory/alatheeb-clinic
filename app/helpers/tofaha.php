<?php

use App\Models\User;

function canDo( $user_id,$department,$action = null){
    $user = User::query()->find($user_id);
    if ($action){
        return ($user->group->permissions->$department->$action ?? 0) == 1;
    }
    $can = true;
    foreach (trans('permissions.actions') as $index => $name){
        $can = $can and ($user->group->permissions->$department->$index ?? 0) == 1;
    }
    return $can;
}
function str_slug($str){
    return \Illuminate\Support\Str::slug($str);
}
function _the($str){
    return __('app.the').__($str);
}
