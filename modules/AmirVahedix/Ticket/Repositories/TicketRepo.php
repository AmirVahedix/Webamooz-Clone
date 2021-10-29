<?php


namespace AmirVahedix\Ticket\Repositories;


use AmirVahedix\Ticket\Models\Ticket;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;


class TicketRepo
{
    private $query;

    public function __construct()
    {
        $this->query = Ticket::query();
    }

    public function searchEmail($email): TicketRepo
    {
        if ($email)
            $this->query->where('users.email', 'LIKE', "%$email%");

        return $this;
    }

    public function searchMobile($mobile): TicketRepo
    {
        if ($mobile)
            $this->query->where('users.mobile', 'LIKE', "%$mobile%");

        return $this;
    }

    public function searchName($name): TicketRepo
    {
        if ($name)
            $this->query->where('users.name', 'LIKE', "%$name%");

        return $this;
    }

    public function searchDate($date): TicketRepo
    {
        if ($date)
            $this->query->whereDate(
                'tickets.created_at',
                '=',
                Jalalian::fromFormat('Y/m/d', $date)->toCarbon()
            );

        return $this;
    }

    public function searchStatus($status): TicketRepo
    {
        if ($status)
            $this->query->where('tickets.status', $status);

        return $this;
    }

    public function joinUsers(): TicketRepo
    {
        $this->query
            ->join('users', 'tickets.user_id', 'users.id')
            ->select('tickets.*', 'users.mobile');

        return $this;
    }

    public function paginate($per_page = 25): LengthAwarePaginator
    {
        return $this->query->latest()->paginate($per_page);
    }

    public function paginateForUser($user_id, $per_page = null): LengthAwarePaginator
    {
        return Ticket::query()->where('user_id', $user_id)
            ->latest()
            ->paginate($per_page);
    }

    public function store(Request $request)
    {
        return Ticket::query()->create([
            'user_id' => auth()->id(),
            'title' => $request->get('title'),
        ]);
    }
}
