<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;

class UsersController
{
    public function fast_excel_user(){
        $users = User::get();
        return (new FastExcel($users))->download('users.xlsx');
    }

    public function fast_excel_application(){
        $application = Application::get();
        return (new FastExcel($application))->export('appliaction.xlsx');
    }

    public function fast_excel_multiple(){
        $sheets = new SheetCollection([
            'Users' => User::all(),
            'Second sheet' => Application::all()
        ]);
        return (new FastExcel($sheets))->export('multiple.xlsx');
    }
}
