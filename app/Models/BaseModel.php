<?php
/**
 * Created by PhpStorm.
 * User: mruongyutthy
 * Date: 1/4/20
 * Time: 21:20
 */
namespace App\Models;

use App\Traits\HasTimestamps;

class BaseModel
{
    use HasTimestamps;

    const RECORD_STATUS_FIELD   = 'record_status_id';
    const RECORD_STATUS_ACTIVE  = 1;
    const RECORD_STATUS_DELETE  = 0;

    const CREATED_AT_FIELD      = 'created_at';
    const CREATED_BY_FIELD      = 'created_by';
    const UPDATED_AT_FIELD      = 'updated_at';
    const UPDATED_BY_FIELD      = 'updated_by';

}