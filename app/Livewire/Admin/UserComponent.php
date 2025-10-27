<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;
    public $search;

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function assignRole(User $user, $value)
    {
        if ($value) {
            $user->assignRole('admin');
        } else {
            $user->removeRole('admin');
        }
    }
    
    public function render()
    {
        $users = User::where('email', '<>', auth()->user()->email)
            ->where(function($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%');
                $query->orWhere('email', 'LIKE', '%' . $this->search . '%');
            })  
            ->paginate();
            // dd($users->toArray());
        return view('livewire.admin.user-component', compact('users'))->layout('layouts.admin');
    }
}
