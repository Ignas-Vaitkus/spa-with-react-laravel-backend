<?php

use App\Models\Employee;
use App\Models\Project;
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
