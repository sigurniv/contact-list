<?php

namespace App\Domain\Contact\Model;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Contact
 * @property int $userId
 * @property string $phone
 * @property string $name
 * @property bool $favorite
 * @package App\Domain\Contact\Model
 */
class Contact extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'userId',
    ];

    protected $attributes = [
        'favorite' => false
    ];
}
