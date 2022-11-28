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
    '/projects/{id}',
    function (Request $request, $id) {
        return response()->json(
            Project::find($id),
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

Route::post('/projects', function (Request $request) {
    $project = new Project;
    $project->name = $request->input('name');
    $project->save();

    return response('', 201);
});

Route::post('/employees', function (Request $request) {
    $employee = new Employee;
    $employee->first_name = $request->input('first_name');
    $employee->last_name = $request->input('last_name');
    $employee->save();

    return response('', 201);
});

Route::put('/projects/{id}', function (Request $request, $id) {
    $project = Project::findOrFail($id);
    $project->name = $request->input('name');
    $project->save();
})->where('id', '[0-9]+');

Route::put('/employees/{id}', function (Request $request, $id) {
    $employee = Employee::findOrFail($id);
    $employee->first_name = $request->input('first_name');
    $employee->last_name = $request->input('last_name');
    $employee->save();
})->where('id', '[0-9]+');

Route::delete('/projects/{id}', function (Request $request, $id) {
    $project = Project::findOrFail($id);
    $project->delete();
})->where('id', '[0-9]+');

Route::delete('/employees/{id}', function (Request $request, $id) {
    $employee = Employee::findOrFail($id);
    $employee->delete();
})->where('id', '[0-9]+');

Route::patch(
    '/employee/{employee_id}/project/{project_id}',
    function (Request $request, $employee_id, $project_id) {
        $employee = Employee::find($employee_id);
        $project = Project::find($project_id);
        $employee->projects()->attach($project);
        $employee->save();
    }
)->where([
    'project_id' => '[0-9]+',
    'employee_id' => '[0-9]+'
]);
