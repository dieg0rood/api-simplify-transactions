<?php

namespace App\Model;

use Hyperf\Database\Model\Events\Creating;
use Hyperf\DbConnection\Model\Model;
use Hyperf\Stringable\Str;

abstract class AbstractModel extends Model
{
    public bool $incrementing = false;
    public function creating(Creating $event)
    {
        if (!$this->id) {
            $this->id = Str::uuid();
        }
    }

}
