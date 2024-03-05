<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use DateTime;


class Dashboard extends Model
{
    use HasFactory;

    public static function getOccurrencesOfMonths() : array
    {
        $companyIds = UserCompany::companyIdsByUser();
        $occurrences = Occurrences::whereIn('company_id', $companyIds )->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as total'))
            ->groupBy('year', 'month')
            ->get()->toArray();
        /**
         * get data save to array make years for key.
         */
        $result = [];
        $year = date("Y");
        for ($month=1; $month<=12; $month++){
            foreach ($occurrences as $data) {
                $year = $data['year'];
                $getMonth = (int) DateTime::createFromFormat('!m', $data['month'])->format('m');
                if(!isset($result[$year][$month])){
                    $result[$year][$month] = 0;
                }

                if( $month === $getMonth){
                    $result[$year][ $month] = (int) $data['total'];
                }
            }

        }

        /** remove array key */
	    if(isset($result[$year])){
		    $result[$year] = array_values($result[$year]);
	    }else{
		    $result[$year] = [];
	    }

        return $result;
    }

    public static function getMonthReport()
    {
        $currentMonth = Carbon::now()->month;
        $previousMonth = (int) Carbon::now()->subMonths()->format('m');

//        dd(self::getOccurrencesOfMonth($currentMonth));

        /** -1 because JS date() fn starting with 0 */
        return [
            $currentMonth => self::getOccurrencesOfMonth($currentMonth),
            $previousMonth => self::getOccurrencesOfMonth($previousMonth),
        ];
    }

    public static function getOccurrencesOfMonth(int $month): array
    {
        $companyIds = UserCompany::companyIdsByUser();
        $occurrences = Occurrences::whereIn('company_id', $companyIds )->select(DB::raw('DATE(created_at) as day'), DB::raw('COUNT(*) as total'))
            ->whereMonth('created_at', $month)
            ->groupBy('day')
            ->get()->toArray();

        return $occurrences ?? [];

    }

    public static function companyDetails(array $companies): array
    {
        $result = [];
        foreach ($companies as $key => $company)
        {
            $company['lists'] = self::getUsersInCompany($company);
            $company['amount'] = self::getUsersAmount($company);
            $result[] = $company;
        }

        return $result;
    }
    public static function getUsersInCompany(array $company): array
    {
        $lists = array();
        $usersCompany = UserCompany::where('company_id', $company['id'])->take(7)->get();
        if($usersCompany->count()){
            foreach ($usersCompany->toArray() as $item){
                $user = User::find($item['user_id'])->toArray();
                $lists[] = $user;
            }
        }

        return $lists;
    }

    public static function getUsersAmount(array $company): int
    {
        $usersCompany = UserCompany::where('company_id', $company['id'])->get();
        return $usersCompany->count() ?? 0;
    }

}
