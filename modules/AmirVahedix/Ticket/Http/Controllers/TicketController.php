<?php


namespace AmirVahedix\Ticket\Http\Controllers;


use AmirVahedix\Ticket\Http\Requests\StoreTicketRequest;

class TicketController
{
    public function index()
    {
        return view('Ticket::index');
    }

    public function create()
    {
        return view("Ticket::create");
    }

    public function store(StoreTicketRequest $request)
    {
        dd($request->validated());
    }
}
