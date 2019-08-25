<?php
namespace App\Http\Controllers;

use App\Domain;
use App\Tools\Fomatter\End;

class DomainController
{
    public function getValidDomain()
    {
        return End::toSuccessJson(Domain::where(Domain::STATUS_FIELD, Domain::VALID_STATUS)->get()->toArray());
    }
}