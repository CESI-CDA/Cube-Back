<?php

namespace App\Services;

use App\Models\LienUserRestriction;
use Carbon\Carbon;

class UserService
{
    public function isActiveRestriction($id_user)
    {
        $restriction = LienUserRestriction::where('id_user', $id_user)
            ->where('deleted', false)
            ->where('date', '>', Carbon::now())
            ->latest('date')
            ->first();

        return $restriction ? true : false;
    }
}
