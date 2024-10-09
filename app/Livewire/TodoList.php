<?php

namespace App\Livewire;

use App\Models\Todo;
use Exception;
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

    #[Rule('required|min:6|max:100')]
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
        try {
            Todo::findOrFail($id)->delete();
        } catch (Exception $e) {
            session()->flash('error', 'Todo cannot be deleted.');
            return;
        }
    }

    function toggle($id)
    {
        $todo = Todo::find($id);

        $todo->completed = !$todo->completed;

        $todo->save();
    }

    function edit($id)
    {
        try {
            $this->editingTodoId = $id;
            $this->editingTodoName = Todo::findOrFail($id)->name;
        } catch (Exception $e) {
            session()->flash('error', 'Todo cannot be edited.');
            return;
        }
    }

    function update()
    {
        try {
            $this->validateOnly('editingTodoName');

            $todo = Todo::findOrFail($this->editingTodoId)->update(
                ['name' => $this->editingTodoName]
            );

            $this->cancelEdit();

            session()->flash('success', 'Todo updated successfully.');
        } catch (Exception $e) {
            session()->flash('error', 'Todo cannot be updated.');
            return;
        }
    }

    function cancelEdit()
    {
        $this->reset('editingTodoId', 'editingTodoName');
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::latest()->where('name', 'like', "%{$this->search}%")->paginate(5),
        ]);
    }
}
