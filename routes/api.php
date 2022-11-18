<?php

use App\Models\Employee;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get(
    '/projects',
    function (Request $request) {
        return response()->json(
            Project::all(),
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
);

Route::get(
    '/project-employees/{id}',
    function (Request $request, $id) {
        $project = Project::find($id);

        return response()->json(
            $project->employees,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
)->where('id', '[0-9]+');

Route::get(
    '/employees',
    function (Request $request) {
        return response()->json(
            Employee::all(),
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
);

Route::get(
    '/employee-projects/{id}',
    function (Request $request, $id) {
        $employee = Employee::find($id);

        return response()->json(
            $employee->projects,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
)->where('id', '[0-9]+');

Route::get(
    '/project-employee',
    function (Request $request) {
        $projects = Project::all();

        foreach ($projects as $project) {

            $project->employees_names = "";

            foreach ($project->employees as $employee) {
                $project->employees_names .= $employee->first_name . ' ' . $employee->last_name . ', ';
            }

            $project->employees_names = substr($project->employees_names, 0, -2);
        }

        return response()->json(
            $projects,
            200,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
);
