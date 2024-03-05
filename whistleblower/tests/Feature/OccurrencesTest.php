<?php

namespace Tests\Feature;

use App\Models\Companies;
use App\Models\Occurrences;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class OccurrencesTest extends TestCase
{
    use RefreshDatabase;


    public function test_generator_password()
    {
        $company = Companies::factory()->create();
        $occurrences = Occurrences::factory()->create();
        $this->assertModelExists($occurrences);

        $this->assertNotNull($occurrences::generatorPassword());

        return $company;
    }

    public function test_send_email()
    {
        $company = Companies::factory()->create();
//        $occurrences = Occurrences::factory()->create();
//        $companyId = $company->id;
//        $settingName = 'test';
//        $settingValue = true;
//        $details = [
//            'email' => 'noom@immerce.co.th',
//            'subject' => 'test email',
//            'name' => 'test name',
//            'company_id' => $companyId,
//            'company_name' => 'Company name',
//            'company_logo_url' => ''
//        ];
//
//        $occurrences->sendEmail($companyId, $settingName, $settingValue, $details);

    }
}
