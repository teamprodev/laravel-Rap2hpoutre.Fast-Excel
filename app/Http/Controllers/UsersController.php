<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;

class UsersController
{
    public function fast_excel_user(){
        $users = User::all();
        return (new FastExcel($users))->download('users.xlsx');
    }

    public function fast_excel_application(){
        $application = Application::all()->makeHidden(['other_files']);
        return (new FastExcel($application))->download('appliaction.xlsx');
    }

    public function fast_excel_multiple(){
        $sheets = new SheetCollection([
            'Users' => User::all(),
            'Second sheet' => Application::all()->makeHidden(['other_files'])
        ]);
        return (new FastExcel($sheets))->download('multiple.xlsx');
    }
    public function fast_excel_chunked(){
        function usersGenerator() {
            foreach (User::cursor() as $user) {
                yield $user;
            }
        }

        // Export consumes only a few MB, even with 10M+ rows.
        return (new FastExcel(usersGenerator()))->download('users.xlsx');
    }
}
