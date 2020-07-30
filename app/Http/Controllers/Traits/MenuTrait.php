<?php

namespace App\Traits;
  
use Illuminate\Http\Request;

trait MenuTrait {

  public function getSidebar () {

    // Companies.

    $numberOfCompanies = \App\Companies::count();

    $menuForCompanies = [
        'text' => "Companies",
        'url' => 'companies',
        'href' => \URL::to('/') . '/companies',
        'icon' => 'far fa-fw fa-file',
        'label' => $numberOfCompanies,
        'label_color' => 'success',
        'class' => '',
    ];

    // Employees.

    $numberOfEmployees = \App\Employees::count();

    $menuForEmployees = [
        'text' => "Employees",
        'url' => 'employees',
        'href' => \URL::to('/') . '/employees',
        'icon' => 'far fa-fw fa-file',
        'label' => $numberOfEmployees,
        'label_color' => 'success',
        'class' => '',
    ];

    $data['menu'] = [
        'sidebar' => [
            $menuForCompanies,
            $menuForEmployees
        ]
    ];

    return $data;

  }

}