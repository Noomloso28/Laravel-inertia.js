<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MailTemplates extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'mailable',
        'subject',
        'html_template',
        'text_template',
        'company_id',
        'type'
    ];
    public $timestamps = true;

    public function __construct(array $attributes = [])
    {
        $this->setTable('mail_templates');
        parent::__construct($attributes);
    }

    public function companies(): BelongsTo
    {
        return $this->belongsTo(Companies::class, 'company_id');
    }

    /**
     * @return array
     */
    public static function templatesLists(): array
    {
        return array_merge(self::getTemplateDefault(), self::getCompanyTemplates());
    }

    /**
     * @return array
     */
    public static function getCompanyTemplates(): array
    {
        $templates = self::with('companies')->whereHas('companies')->get();
        return ($templates->count()) ? $templates->toArray() : [];
    }

    /**
     * @return array
     */
    public static function getTemplateDefault(): array
    {
        $template = self::where('default', true)->get();
        return ($template->count()) ? $template->toArray() : [];
    }

}
