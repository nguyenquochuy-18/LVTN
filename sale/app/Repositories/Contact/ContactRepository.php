<?php

namespace App\Repositories\Contact;

use App\Models\Contact;
use App\Repositories\Base\BaseRepository;

class ContactRepository extends BaseRepository implements ContactRepositoryInterface
{
    public function __construct(Contact $model)
    {
        parent::__construct($model);
    }
}
