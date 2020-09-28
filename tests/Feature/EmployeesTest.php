<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Employees;

class EmployeesTest extends TestCase
{
    public function createTestEmployee()
    {
        return factory(Employees::class)->create();
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
        // Create a Employee to test.
        $createTestEmployee = $this->createTestEmployee();
        $response = $this->json('POST', "/employees/store", $createTestEmployee->toArray());
        (Employees::class)::destroy($createTestEmployee['id']);
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
        (Employees::class)::destroy($createTestEmployee['id']);
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
        (Employees::class)::destroy($createTestEmployee['id']);
        // Redirects on success.
        $response->assertStatus(302);
    }
}
