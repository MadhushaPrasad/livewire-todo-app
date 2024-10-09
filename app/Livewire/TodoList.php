<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;

class TodoList extends Component
{
    #[Rule('required|min:6|max:100')]
    public $name = '';

    public function create()
    {
        // validation
        // create the todo
        // clear the input
        // send flash message

        $validated = $this->validateOnly('name');
        Todo::create($validated);

        $this->reset('name');

        session()->flash('success', 'Todo created successfully.');
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest()->get()
        ]);
    }
}
