<?php

namespace Tests\Feature;

use App\Models\Categories;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;


class CategoriesTest extends TestCase
{
    use RefreshDatabase;
	function test_categories_url_exits()
	{
		$response = $this->get('/company/categories');
		$response->statusText();
	}

	public function test_can_get_category_type_default()
	{
		$categories = Categories::factory()->create();
		$this->assertModelExists($categories);
		$this->assertIsArray($categories::getDefault());

	}
	public function test_get_companies_of_user()
	{
		$categories = Categories::factory()->create();
		$companies = $categories::getCompanies();

		$this->assertIsArray($companies);
	}

	public function test_get_categories_by_company_id()
	{
		$categories = Categories::factory()->create();
		$companyId = 1000;

		$companies = $categories::getCategoryById($companyId);

		$this->assertIsArray($companies);
		$this->assertNotNull($companies);
	}

	public function test_get_enabled_cagegory_by_id()
	{
		$categories = Categories::factory()->create();
		$companyId = 0;

		$categoriesByCompany = $categories::getEnabledCagegoryById($companyId);

		$this->assertIsArray($categoriesByCompany);
	}
}
