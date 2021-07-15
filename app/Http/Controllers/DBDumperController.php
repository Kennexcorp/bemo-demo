<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Spatie\DbDumper\Databases\MySql;

class DBDumperController extends Controller
{
    //
    public function dumpDatabase()
    {

        File::put('bemo.sql', '');

        $value = MySql::create()
            ->setDbName(env('DB_DATABASE'))
            ->setUserName(env('DB_USERNAME'))
            ->setPassword(env('DB_PASSWORD'))
            ->setHost(env('DB_HOST'))
            ->setPort(env('DB_PORT'))
            ->dumpToFile(base_path('bemo.sql'));

        $headers = array(
            'Content-Type: application/*',
        );

        $pathToFile = base_path() . '/bemo.sql';

        return response()->download($pathToFile, 'bemo.sql', $headers);;
    }
}
