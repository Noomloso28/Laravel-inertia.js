<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Notifications extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'type',
        'notifiable_id',
        'data',
        'read_at'
        ];

    /**
     * @param array $notifications
     * @return array
     */
    public function getOccurrences(array $notifications)
    {
        $result = [];
        if(Session::has('company.id')){
            foreach ($notifications as $key => $values){
                if(is_numeric($values['data']['id'])){
                    $occurrences = Occurrences::with(['companies', 'categories', 'departments', 'whistleblower', 'files'])
                        ->where('id', $values['data']['id'] )
                        ->where('company_id', Session::get('company.id'))
                        ->first();

                    if($occurrences){
                        $values['occurrence'] = $occurrences;
                        $result[] = $values;
                    }
                }
            }
        }

        return $result;
    }
}
