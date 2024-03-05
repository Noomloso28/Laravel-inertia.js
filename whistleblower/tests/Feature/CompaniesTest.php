<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Companies;

class CompaniesTest extends TestCase
{
	use RefreshDatabase;

	public function test_get_all_companies()
	{
		$companies = Companies::factory()->create();
		$lists = $companies::allCompanies();

		$this->assertIsArray($lists);
	}

	public function test_update_category_by_ids()
	{
		$companies = Companies::factory()->create();
		$companyId = 0;
		$categoryIds = [];
		$this->assertModelExists($companies);

		$update = $companies::updateCategories($companyId, $categoryIds);
		$this->assertIsArray($update);
	}

	public function test_update_department_by_ids()
	{
		$companies = Companies::factory()->create();
		$companyId = 0;
		$categoryIds = [];
		$this->assertModelExists($companies);

		$update = $companies::updateDepartments($companyId, $categoryIds);
		$this->assertIsArray($update);
	}
}
