<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingDeveloper extends Model
{
    use SoftDeletes;

    public $columns = [
        [
            'name' => 'app_debug',
            'type' => 'boolean',
            'rule' => 'boolean',
            'form_type' => 'checkbox',
            'help' => 'Users can see error with details.',
        ],
        [
            'name' => 'app_env',
            'type' => 'boolean',
            'rule' => 'boolean',
            'form_type' => 'switch-bootstrap-m',
        ],
        [
            'name' => 'theme',
            'type' => 'string',
            'rule' => 'required',
            'form_type' => 'enum',
            'form_enum_class' => 'ThemeType',
            'help' => 'capp is only theme of this cms',
        ],
        [
            'name' => 'throttle',
            'type' => 'string',
            'rule' => '',
            'form_type' => '',
            'help' => 'Stop users who is requesting alot to server.',
            'database' => 'nullable',
        ],
        [
            'name' => 'lazy_loading',
            'type' => 'boolean',
            'rule' => 'boolean',
            'form_type' => 'checkbox',
            'help' => 'Lazy loading is neccessary for fast website initial loading.',
        ],
        [
            'name' => 'email_username',
            'type' => 'string',
            'rule' => 'email',
            'form_type' => '',
            'help' => 'email that is used for sending emails to users.',
            'database' => 'nullable',
        ],
        [
            'name' => 'email_password',
            'type' => 'string',
            'rule' => '',
            'form_type' => '',
            'help' => 'email password that is used for sending emails to users.',
            'database' => 'nullable',
        ],
        [
            'name' => 'email_default_subject',
            'type' => 'string',
            'rule' => '',
            'form_type' => '',
            'database' => 'nullable',
        ],
        [
            'name' => 'email_default_ccc',
            'type' => 'string',
            'rule' => '',
            'form_type' => '',
            'database' => 'nullable',
        ],
        [
            'name' => 'scripts',
            'type' => 'text',
            'rule' => '',
            'form_type' => 'textarea',
            'database' => 'nullable',
        ],
    ];

    protected $guarded = [];

    protected $hidden = [
        'deleted_at',
    ];

    public function getColumns()
    {
        return $this->columns;
    }
}
