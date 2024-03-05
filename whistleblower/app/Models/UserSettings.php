<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Configs\Setting;
class UserSettings extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'value',
        'active',
        'permission'
    ];

    public static function emailNotifications()
    {
        return [
          'occurrences' => [
              Setting::SETTING_OCCURRENCE_CREATED => [
                  'label' => 'Created',
                  'name' => Setting::SETTING_OCCURRENCE_CREATED,
                  'value' => (boolean) self::getValue(Setting::SETTING_OCCURRENCE_CREATED, 'value'), //checkbox need boolean type for checked.
                  'permission' => true
                  ],
              Setting::SETTING_OCCURRENCE_UPDATED => [
                  'label' => 'Updated',
                  'name' => Setting::SETTING_OCCURRENCE_UPDATED,
                  'value' => (boolean) self::getValue(Setting::SETTING_OCCURRENCE_UPDATED, 'value'),
                  'permission' => true
              ],
              Setting::SETTING_OCCURRENCE_DELETED => [
                  'label' => 'Deleted',
                  'name' => Setting::SETTING_OCCURRENCE_DELETED,
                  'value' => (boolean) self::getValue(Setting::SETTING_OCCURRENCE_DELETED, 'value'),
                  'permission' => true
              ]
          ],
            'users' => [
                0 => [
                    'label' => 'Created',
                    'name' => 'user.created',
                    'value' => false,
                    'permission' => true
                ],
                1 => [
                    'label' => 'Updated',
                    'name' => 'user.updated',
                    'value' => false,
                    'permission' => true
                ],
                2 => [
                    'label' => 'Deleted',
                    'name' => 'user.deleted',
                    'value' => false,
                    'permission' => true
                ]
            ]
        ];
    }

    /**\
     * @param $name
     * @param $field
     * @return mixed|null
     */
    public static function getValue($name ='', $field ='')
    {
        $select = self::select('*')
            ->where([
                'user_id' => Auth::id(),
                'name' => $name
            ])
            ->get()->first();
        return $select[$field] ?? null;
    }
    /**

     * @param array $array1
     * @param array $array2
     * @param array|null $keysToCompare
     * @return array
     */
    public static function arrayDifference(array $array1, array $array2, array $keysToCompare = null) {
        $serialize = function (&$item, $idx, $keysToCompare) {
            if (is_array($item) && $keysToCompare) {
                $a = array();
                foreach ($keysToCompare as $k) {
                    if (array_key_exists($k, $item)) {
                        $a[$k] = $item[$k];
                    }
                }
                $item = $a;
            }
            $item = serialize($item);
        };

        $deserialize = function (&$item) {
            $item = unserialize($item);
        };

        array_walk($array1, $serialize, $keysToCompare);
        array_walk($array2, $serialize, $keysToCompare);

        // Items that are in the original array but not the new one
        $deletions = array_diff($array1, $array2);
        $insertions = array_diff($array2, $array1);

        array_walk($insertions, $deserialize);
        array_walk($deletions, $deserialize);

//        return array('insertions' => $insertions, 'deletions' => $deletions);

        return $insertions;
    }
    public static function getEmailTemplate(): string
    {
        $where = [
//            'user_id' => Auth::id(),
            'name' => 'email.template'
        ];
        $result = self::where($where)->pluck('value');

        return $result[0] ?? '';
    }
}
