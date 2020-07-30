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
        'icon' => 'far fa-fw fa-building',
        'label' => ($numberOfCompanies > 0) ? $numberOfCompanies : 0,
        'label_color' => 'info',
        'class' => '',
    ];

    // Employees.

    $numberOfEmployees = \App\Employees::count();

    $menuForEmployees = [
        'text' => "Employees",
        'url' => 'employees',
        'href' => \URL::to('/') . '/employees',
        'icon' => 'fas fa-fw fa-user-tie',
        'label' => ( $numberOfEmployees > 0 ) ? $numberOfEmployees : 0,
        'label_color' => 'info',
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