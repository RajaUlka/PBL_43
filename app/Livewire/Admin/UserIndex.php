<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserIndex extends Component
{
    public $users;
    public $name, $email, $password, $role;
    public $editId = null;
    public $showModal = false;  // Untuk mengontrol modal
    public $status = '';
    public $filterRole = '';
    public $search = '';

    

    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'role' => 'required|string|in:admin,user,teknisi',
    ];
    

    public function mount()
    {
        $this->filterRole = '';
        $this->fetchUsers();
    }

    public function fetchUsers()
    {
        $query = User::query();
    
        if ($this->filterRole) {
            $query->where('role', $this->filterRole);
        }
    
        $this->users = $query->get();
    }
    

    public function store()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        $this->resetForm();
        $this->fetchUsers();
        $this->showModal = false;  // Menutup modal setelah simpan
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->editId = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->showModal = true;  // Menampilkan modal untuk edit
    }

    public function update()
    {
        $user = User::findOrFail($this->editId);

        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->editId,
            'role' => 'required|string|in:admin,user,teknisi',
        ]);
        

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ]);

        $this->resetForm();
        $this->fetchUsers();
        $this->showModal = false;  // Menutup modal setelah update
    }

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        $this->fetchUsers();
    }

    

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }


    public function closeModal()
    {
        $this->resetForm();
        $this->showModal = false;  // Menutup modal
    }

    public function resetForm()
    {
        $this->reset(['name', 'email', 'password', 'role', 'editId']);
    }

    public function render()
    {
        $query = User::query();
    
        if ($this->filterRole) {
            $query->where('role', $this->filterRole);
        }
    
        $users = $query->get();
    
        return view('livewire.admin.user-index', [
            'users' => $users
        ]);
    }
    

    public function updatedFilterRole()
{
    $this->fetchUsers();
}

    
    
}
