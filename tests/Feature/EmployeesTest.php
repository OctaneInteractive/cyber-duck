<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Faker\Generator as Faker;

use App\Companies;
use App\Employees;

use App\Traits\UnitTestTrait;

class EmployeesTest extends TestCase
{

    use UnitTestTrait;

    public function createTestEmployee()
    {
        return factory(Employees::class)->create();
    }

    public function getNextCompanyId()
    {
        // Get the Auto Increment value for the `companies` table.
        $companiesAutoIncrementId = $this->getCompaniesAutoIncrementId()->getData();
        return $companiesAutoIncrementId->id;
    }

    public function getNextEmployeeId()
    {
        // Get the Auto Increment value for the `employees` table.
        $employeesAutoIncrementId = $this->getEmployeesAutoIncrementId()->getData();
        return $employeesAutoIncrementId->id;
    }

    /**
     * List of the Employees.
     *
     * @return void
     */
    public function testEmployees()
    {
        $response = $this->get("/employees");
        $response->assertStatus(200);
    }

    /**
     * Create.
     *
     * @return void
     */
    public function testEmployeesCreate()
    {
        $response = $this->get("/employees/create");
        $response->assertStatus(200);
    }

    /**
     * Store.
     *
     * @return void
     */
    public function testEmployeesStore()
    {
        $faker = \Faker\Factory::create();
        $employeeData = [
            'id' => (int) $this->getNextEmployeeId(),
            'name_first' => $faker->firstNameMale(),
            'name_last' => $faker->lastName(),
            'email' => $faker->email,
            'telephone' => mt_rand(10000000000, 99999999999),
            'company_id' => rand(1, ( $this->getNextCompanyId() - 1 )),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ];
        $response = $this->json('POST', "/employees/store", $employeeData);
        Companies::destroy($employeeData['id']);
        // Redirects on success.
        $response->assertStatus(302);
    }

    /**
     * Edit.
     *
     * @return void
     */
    public function testEmployeesEdit()
    {
        // Create a Employee to test.
        $createTestEmployee = $this->createTestEmployee();
        $response = $this->get("/employees/edit/{$createTestEmployee->id}");
        (Employees::class)::destroy($createTestEmployee->id);
        $response->assertStatus(200);
    }

    /**
     * Update.
     *
     * @return void
     */
    public function testEmployeesUpdate()
    {
        // Create a Employee to test.
        $createTestEmployee = $this->createTestEmployee();
        $response = $this->json('PATCH', "/employees/{$createTestEmployee->id}", [
            'name_first' => 'Wayne',
            'name_last' => 'Smallman',
            'email' => 'info@octane.uk.net',
            'telephone' => '07995123456'
        ]);
        (Employees::class)::destroy($createTestEmployee->id);
        // Redirects on success.
        $response->assertStatus(302);
    }

    /**
     * Delete.
     *
     * @return void
     */
    public function testEmployeesDelete()
    {
        // Create a Employee to test.
        $createTestEmployee = $this->createTestEmployee();
        $response = $this->json('DELETE', "/employees/{$createTestEmployee->id}");
        (Employees::class)::destroy($createTestEmployee->id);
        // Redirects on success.
        $response->assertStatus(302);
    }
}
