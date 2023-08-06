<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\interfaces\GraduatedRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    protected $graduated;

    public function __construct(GraduatedRepositoryInterface $graduated)
    {
        $this->graduated = $graduated;
    }

    public function index()
    {

        return $this->graduated->index();
    }


    public function create()
    {
        return $this->graduated->create();

    }

    public function update(Request $request)
    {
        return $this->graduated->update($request);

    }


    public function store(Request $request)
    {
        return $this->graduated->softDelete($request);
    }


    public function destroy(Request $request)
    {
        return $this->graduated->destroy($request);
    }
}
