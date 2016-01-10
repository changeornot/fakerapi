<?php
/**
 * Created by PhpStorm.
 * User: YuGang Yang
 * Date: 1/11/16
 * Time: 12:17 AM
 */

namespace App\Entity;


class Image extends BaseEntity
{

    protected $fillable = ['url', 'user_id'];

    protected $hidden = [
        'user_id',
        'imageable_id',
        'imageable_type',
        'created_at',
        'updated_at',
    ];

    /**
     * @return MorphTo
     */
    public function mediable()
    {
        return $this->morphTo();
    }

}