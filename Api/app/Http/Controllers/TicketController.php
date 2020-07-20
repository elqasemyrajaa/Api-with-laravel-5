<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use App\Http\Resources\TicketResource as ResourcesTicket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = Ticket::paginate(15);
        return ResourcesTicket::collection($tickets);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket = $request->isMethod('put') ? Ticket::findOrFail($request->ticket_id) : new Ticket();
        $ticket->id = $request->input('ticket_id');
        $ticket->name = $request->input('name');
        $ticket->date = $request->input('date');
        $ticket->description = $request->input('description');
        $ticket->project_id = $request->input('project_id');
        $ticket->status_id = $request->input('status_id');
        if ($ticket->save()) {
            return new ResourcesTicket($ticket);
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
        $ticket = Ticket::findOrFail($id);
        return new ResourcesTicket($ticket);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        if ($ticket->delete()) {
            return new ResourcesTicket($ticket);
        }
    }
}
