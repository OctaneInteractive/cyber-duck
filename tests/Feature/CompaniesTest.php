<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Companies;

class CompaniesTest extends TestCase
{
    public function createTestCompany()
    {
        return factory(Companies::class)->create();
    }

    /**
     * List of the Companies.
     *
     * @return void
     */
    public function testCompanies()
    {
        $response = $this->get("/companies");
        $response->assertStatus(200);
    }

    /**
     * Create.
     *
     * @return void
     */
    public function testCompaniesCreate()
    {
        $response = $this->get("/companies/create");
        $response->assertStatus(200);
    }

    /**
     * Store.
     *
     * @return void
     */
    public function testCompaniesStore()
    {
        // Create a Company to test.
        $createTestCompany = $this->createTestCompany();
        $response = $this->json('POST', "/companies/store", $createTestCompany->toArray());
        (Companies::class)::destroy($createTestCompany['id']);
        // Redirects on success.
        $response->assertStatus(302);
    }

    /**
     * Edit.
     *
     * @return void
     */
    public function testCompaniesEdit()
    {
        // Create a Company to test.
        $createTestCompany = $this->createTestCompany();
        $response = $this->get("/companies/edit/{$createTestCompany->id}");
        (Companies::class)::destroy($createTestCompany['id']);
        $response->assertStatus(200);
    }

    /**
     * Update.
     *
     * @return void
     */
    public function testCompaniesUpdate()
    {        
        // Create a Company to test.
        $createTestCompany = $this->createTestCompany();
        $response = $this->json('PATCH', "/companies/{$createTestCompany->id}", [
            'name' => 'Octane Interactive Limited',
            'email' => 'info@octane.uk.net'
        ]);
        (Companies::class)::destroy($createTestCompany['id']);
        // Redirects on success.
        $response->assertStatus(302);
    }
}
