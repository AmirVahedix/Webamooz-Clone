<?php


namespace AmirVahedix\Ticket\Http\Controllers;


use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\Ticket\Http\Requests\StoreTicketRequest;
use AmirVahedix\Ticket\Repositories\TicketRepo;
use AmirVahedix\Ticket\Services\ReplyService;

class TicketController
{
    private $ticketRepo;

    public function __construct(TicketRepo $ticketRepo)
    {
        $this->ticketRepo = $ticketRepo;
    }

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
        $ticket = $this->ticketRepo->store($request);
        ReplyService::store($ticket, $request->get('body'), $request->file('attachment'));

        toast('تیکت باموفقیت ایجاد شد.', 'success');
        return redirect(route('dashboard.tickets.index'));
    }
}
