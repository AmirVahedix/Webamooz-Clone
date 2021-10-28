<?php


namespace AmirVahedix\Ticket\Http\Controllers;


use AmirVahedix\Authorization\Models\Permission;
use AmirVahedix\Ticket\Http\Requests\StoreReplyRequest;
use AmirVahedix\Ticket\Http\Requests\StoreTicketRequest;
use AmirVahedix\Ticket\Models\Ticket;
use AmirVahedix\Ticket\Repositories\TicketRepo;
use AmirVahedix\Ticket\Services\ReplyService;
use AmirVahedix\User\Models\User;

class TicketController
{
    private $ticketRepo;

    public function __construct(TicketRepo $ticketRepo)
    {
        $this->ticketRepo = $ticketRepo;
    }

    public function index()
    {
        if (auth()->user()->hasAnyPermission([Permission::PERMISSION_MANAGE_TICKETS, Permission::PERMISSION_SUPER_ADMIN])) {
            $tickets = $this->ticketRepo->paginate();
        } else {
            $tickets = $this->ticketRepo->paginateForUser(auth()->id());
        }

        return view('Ticket::index', compact('tickets'));
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

    public function show(Ticket $ticket)
    {
        return view('Ticket::show', compact('ticket'));
    }

    public function reply(StoreReplyRequest $request, Ticket $ticket)
    {
        ReplyService::store($ticket, $request->get('body'), $request->file('attachment'));

        if (auth()->id() != $ticket->user_id) {
            $ticket->update([ 'status' => Ticket::STATUS_ANSWERED ]);
        } else {
            $ticket->update([ 'status' => Ticket::STATUS_WAITING ]);
        }

        toast('پاسخ باموفقیت ثبت شد.', 'success');
        return redirect(route('dashboard.tickets.show', $ticket->id));
    }
}
