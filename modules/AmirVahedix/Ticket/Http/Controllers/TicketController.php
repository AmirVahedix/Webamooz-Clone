<?php


namespace AmirVahedix\Ticket\Http\Controllers;


use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\Ticket\Http\Requests\StoreTicketRequest;
use AmirVahedix\Ticket\Repositories\TicketRepo;

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
        $this->ticketRepo->store($request);

        if ($request->hasFile('attachment')) {
            $media_id = MediaService::privateUpload($request->file('attachment'))->id;
//            $request->request->add(['media_id', $media_id]);
        }


    }
}
