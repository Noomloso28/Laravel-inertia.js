<?php

namespace Tests\Feature;

use App\Models\Departments;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepartmentsTest extends TestCase
{
	use RefreshDatabase;

	public function test_get_departments_belong_to()
	{
		$departments = Departments::factory()->create();
		$this->assertModelExists($departments);

		$companies = $departments->companies();
		$this->assertIsNotArray($companies);

		$default = $departments::getDefault();
		$this->assertIsArray($default);
//		$this->assertCount();
	}

    public function test_get_user_departments()
    {
        $departments = Departments::factory()->create();
        $this->assertModelExists($departments);

        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

        $userDepartment = $departments::userDepartments();
        $this->assertIsArray($userDepartment);

    }
    public function test_get_departments_by_company_id()
    {
        $departments = Departments::factory()->create();
        $companyId = 0;
        $departments::getEnabledDepartmentById($companyId);

        $this->assertIsArray($departments);
    }
}
