<?php

namespace App\Traits;
  
use Illuminate\Http\Request;

use DB;

trait UnitTestTrait {

  public function getCompaniesAutoIncrementId () {

    $statement = DB::select("SHOW TABLE STATUS LIKE 'companies'");

    return response()->json(['id' => $statement[0]->Auto_increment]);

  }

  public function getEmployeesAutoIncrementId () {

    $statement = DB::select("SHOW TABLE STATUS LIKE 'employees'");

    return response()->json(['id' => $statement[0]->Auto_increment]);

  }

}