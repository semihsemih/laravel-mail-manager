<?php

namespace BinaryBuilds\LaravelMailManager\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MailManagerMail
 */
class MailManagerMail extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'uuid',
        'recipients',
        'subject',
        'mailable_name',
        'mailable',
        'is_queued',
        'is_notification',
        'notifiable',
        'is_sent',
        'tries',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'uuid' => 'string',
        'recipients' => 'array',
        'subject' => 'string',
        'mailable_name' => 'string',
        'mailable' => 'string',
        'is_queued' => 'boolean',
        'is_notification' => 'boolean',
        'notifiable' => 'string',
        'is_sent' => 'boolean',
        'tries' => 'integer',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * MailManagerMail constructor.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTable(config('mail_manager.table_name'));
    }

    /**
     * @return mixed
     */
    public function getNotificationAttribute()
    {
        return $this->attributes['mailable'];
    }

    public function setNotificationAttribute($attribute)
    {
        $this->attributes['mailable'] = $attribute;
    }
}
