<?php


namespace AmirVahedix\Ticket\Http\Controllers;


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
}
