<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Company;

class CompanyService
{
    public function createBusiness($user)
    {
        $team    = new Company();
        $team->owner_id = $user->id;
        $team->name = $user->company_name;
        $team->save();

        // team attach alias
        $user->attachTeam($team);
    }
}

?>
