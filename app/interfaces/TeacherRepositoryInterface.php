<?php

namespace App\interfaces;

interface TeacherRepositoryInterface
{

    public function getAllTeachers();

    public function StoreTeacher($request);

    public function EditTeacher($id);

    public function UpdateTeacher($request);

    public function DeleteTeachers($request);

    public function getSpecialization();

    public function getGenders();


}
