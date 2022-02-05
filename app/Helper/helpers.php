<?php

use App\Models\Access;
use Illuminate\Support\Facades\Auth;

function canSee($page)
{

    $utype = Auth::user()->sub_agent != NULL ? "sub_agent" : "agent";


    $access = Access::where('user_type', $utype)->first();

    $arr = explode(",", $access->permitted_access);

    if (in_array($page, $arr)) {
        return true;
    }

    return false;
}
