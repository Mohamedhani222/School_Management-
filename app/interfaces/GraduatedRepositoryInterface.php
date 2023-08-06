<?php

namespace App\interfaces;

interface GraduatedRepositoryInterface
{

    public function index();

    public function create();
    public function update($request);
    public function softDelete($request);

    public function destroy($request);

}
