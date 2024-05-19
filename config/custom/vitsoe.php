<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Custom Configuration File
    |--------------------------------------------------------------------------
    |
    | This file is for storing the custom configuration of the application
    |
    */

    'database' => [
        'records_per_page' => env('RECORDS_PER_PAGE', 20),
    ],
    'api' => [
        'request_per_min' => env('REQUEST_PER_MIN', 10),
    ],

];
