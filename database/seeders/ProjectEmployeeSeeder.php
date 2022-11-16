<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectEmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projectNames = [
            'E-Shop',
            'Enterprise Resource Planning',
            'CRUD App'
        ];

        $employeeNames = [
            ['Jonas', 'Jonaitis'],
            ['Petras', 'Petraitis'],
            ['Zita', 'Zitaitė'],
            ['Rolandas', 'Kazlas'],
            ['Dalia', 'Grybauskaitė'],
            ['Ingrida', 'Šimonytė']
        ];

        $projects = [];

        foreach ($projectNames as $projectName) {
            $project = new Project();
            $project->name = $projectName;
            $project->save();

            array_push($projects, $project);
        }

        $employees = [];

        foreach ($employeeNames as $employeeName) {
            $employee = new Employee();
            $employee->first_name = $employeeName[0];
            $employee->last_name = $employeeName[1];
            $employee->save();

            array_push($employees, $employee);
        }

        $projects[0]->employees()->attach($employees[0]);
        $projects[0]->employees()->attach($employees[1]);
        $projects[0]->employees()->attach($employees[4]);
        $projects[1]->employees()->attach($employees[0]);
        $projects[1]->employees()->attach($employees[2]);
        $projects[1]->employees()->attach($employees[3]);
        $projects[2]->employees()->attach($employees[3]);
        $projects[2]->employees()->attach($employees[4]);
        $projects[2]->employees()->attach($employees[5]);

        foreach ($projects as $project) {
            $project->save();
        }
    }
}
