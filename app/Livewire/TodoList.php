<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{

    use WithPagination;

    #[Rule('required|min:6|max:100')]
    public $name = '';

    public $search = '';

    public $editingTodoId;
    public $editingTodoName;

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

    public function delete($id)
    {
        Todo::find($id)->delete();
    }

    function toggle($id)
    {
        $todo = Todo::find($id);

        $todo->completed = !$todo->completed;

        $todo->save();
    }

    function edit($id)
    {
        $this->editingTodoId = $id;
        $this->editingTodoName = Todo::find($id)->name;
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(5),
        ]);
    }
}
