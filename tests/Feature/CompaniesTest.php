<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Faker\Generator as Faker;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use App\Companies;

use App\Traits\UnitTestTrait;

class CompaniesTest extends TestCase
{

    use UnitTestTrait;

    public function createTestCompany()
    {
        return factory(Companies::class)->create();
    }

    public function getNextCompanyId()
    {
        // Get the Auto Increment value for the `companies` table.
        $companiesAutoIncrementId = $this->getCompaniesAutoIncrementId()->getData();
        return $companiesAutoIncrementId->id;
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
        Storage::fake('public');
        $faker = \Faker\Factory::create();
        $companyData = [
            'id' => (int) $this->getNextCompanyId(),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'name' => $faker->company,
            'email' => $faker->email,
            'logo' => UploadedFile::fake()->image('testing.jpg', 100, 100)
        ];
        $response = $this->json('POST', "/companies/store", $companyData);
        Companies::destroy($companyData['id']);
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
        Companies::destroy($createTestCompany->id);
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
        (Companies::class)::destroy($createTestCompany->id);
        // Redirects on success.
        $response->assertStatus(302);
    }

    /**
     * Delete.
     *
     * @return void
     */
    public function testCompaniesDelete()
    {
        $faker = \Faker\Factory::create();
        // Create a Company to test.
        $companyLogo = $faker->image(public_path('logos'), 100, 100, 'business', false);
        $companyId = \DB::table('companies')->insertGetId([
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            'name' => $faker->company,
            'email' => $faker->email,
            'logo' => $companyLogo
        ]);
        $response = $this->json('DELETE', "/companies/{$companyId}");
        // Redirects on success.
        $response->assertStatus(302);
    }
}
