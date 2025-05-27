<?php

namespace App\Http\Controllers\Api\test;

use App\Http\Controllers\Api\BaseApiTrait;
use App\Models\Test;
use App\Http\Controllers\Controller;

class test2 extends Controller
{
    use BaseApiTrait;

    /**
     * Get the model class name.
     *
     * @return string
     */
    protected function getModelClass()
    {
        return Test::class;
    }
    
    /**
     * Get validation rules for storing a new record.
     *
     * @return array
     */
    protected function getStoreValidationRules()
    {
        return [
           'text' => 'required|string|max:255',
        ];
    }
    
    /**
     * Get validation rules for updating a record.
     *
     * @return array
     */
    protected function getUpdateValidationRules()
    {
        return [
          'text' => 'required|string|max:255',
        ];
    }
}
