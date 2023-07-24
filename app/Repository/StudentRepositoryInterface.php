<?php

namespace App\Repository;


interface StudentRepositoryInterface
{
    public function Get_Students();

    public function Create_Student();

    public function Edit_Student($id);

    public function Show_Student($id);

    public function add_attachment($request);

    public function Delete_Student($request);

    public function Update_Student($request);

    public function Store_Student($request);

    public function Get_classrooms($id);

    public function Get_sections($id);

    public function export_students();

    public function extracted($request, $student);
}
