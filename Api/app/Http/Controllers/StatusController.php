<?php

namespace App\Http\Controllers;

use App\Http\Resources\StatusResource as ResourcesStatuts;
use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Status::paginate(15);
        return ResourcesStatuts::collection($status);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = $request->isMethod('put') ? Status::findOrFail($request->status_id) : new Status();
        $status->id = $request->input('status_id');
        $status->status = $request->input('status');

        if ($status->save()) {
            return new ResourcesStatuts($status);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $status = Status::findOrFail($id);
        return new ResourcesStatuts($status);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::findOrFail($id);
        if ($status->delete()) {
            return new ResourcesStatuts($status);
        }
    }
}
