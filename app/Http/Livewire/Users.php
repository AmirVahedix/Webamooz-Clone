<?php

namespace App\Http\Livewire;

use AmirVahedix\User\Models\User;
use AmirVahedix\User\Repositories\UserRepo;
use Livewire\Component;

class Users extends Component
{
    public $search = "";

    public function render(UserRepo $userRepo)
    {
        $users = $this->search
            ? User::where('email', 'LIKE', "%$this->search%")
                ->orWhere('mobile', 'LIKE', "%$this->search%")
                ->orWhere('name', 'LIKE', "%$this->search%")
                ->orWhere('username', 'LIKE', "%$this->search%")
                ->get()
            : $userRepo->paginate();

        return view('livewire.users', compact('users'));
    }
}
