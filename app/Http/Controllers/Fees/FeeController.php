<?php

namespace App\Http\Controllers\Fees;

use App\Http\Controllers\Controller;
use App\Http\Requests\FeesRequest;
use App\interfaces\FeesRepositoryInterface;
use App\Models\Fee;
use Illuminate\Http\Request;

class FeeController extends Controller
{
    private FeesRepositoryInterface $fees;

    public function __construct(FeesRepositoryInterface $fees)
    {
        $this->fees = $fees;
    }

    public function index()
    {
        return $this->fees->index();
    }

    public function create()
    {
        return $this->fees->create();
    }

    public function store(FeesRequest $request)
    {

        return $this->fees->store($request,$request->validated());
    }

    public function show(Fee $fee)
    {
        //
    }

    public function edit($id)
    {
        return $this->fees->edit($id);
    }

    public function update(FeesRequest $request,$data)
    {
        return $this->fees->update($request,$request->validated());
    }

    public function destroy(Request $request)
    {
        return $this->fees->destroy($request);
    }
}
