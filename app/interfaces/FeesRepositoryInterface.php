<?php

namespace App\interfaces;

interface FeesRepositoryInterface
{
    public function index();

    public function create();

    public function store($request, $data);

    public function edit($id);

    public function update($request,$data);

    public function destroy($request);
}
