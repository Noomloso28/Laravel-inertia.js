<?php

namespace Tests\Feature;

use App\Models\Companies;
use App\Models\User;
use App\Models\UserCompany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserCompanyTest extends TestCase
{
    use RefreshDatabase;

    public function test_companies_by_user()
    {

        $this->actingAs($user = User::factory()->create());
        $companies = Companies::factory()->create();
        $companies = UserCompany::factory()->create();
        $this->assertModelExists($companies);

        $this->assertIsArray($companies::companiesByUser());
//        $this->assertCount(1, $companies::companiesByUser());

        $this->assertNotNull($companies::companyIdsByUser());
//        $this->assertContains();
    }
}
