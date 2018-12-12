<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class UuidObserver
{
    /**
     * Listen to the Model creating event.
     *
     * @param  \Illuminate\Database\Eloquent\Model $model
     * @return void
     * @throws \Exception
     */
    public function creating(Model $model)
    {
        $model->uuid = Uuid::uuid4()->toString();
    }
}
