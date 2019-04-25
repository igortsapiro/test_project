<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $table = 'test';

    const COUNT_PAGINATE = 25; //count fields per 1 page
    const ALL_TEST_FIELDS = 10000; // count of all test fields in table

    public $timestamps = false;


}
