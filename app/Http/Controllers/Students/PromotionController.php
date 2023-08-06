<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\interfaces\StudentPromotionRepositoryInterface;
use App\Models\Student;
use Illuminate\Http\Request;

class PromotionController extends Controller
{

    protected $student_promotion;

    public function __construct(StudentPromotionRepositoryInterface $student_promotion)
    {
        $this->student_promotion = $student_promotion;
    }

    public function index()
    {

        return $this->student_promotion->index();
    }

    public function create()
    {
        return $this->student_promotion->create();

    }

    public function store(Request $request)
    {
            return $this->student_promotion->store($request);
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(Request $request)
    {
        return $this->student_promotion->destroy($request);
    }
}
