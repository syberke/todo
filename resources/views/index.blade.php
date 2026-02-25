<!DOCTYPE html>
<html>
<head>
    <title>Todo App</title>
</head>
<body>

<h1>Todo List</h1>

<form action="{{ route('todos.store') }}" method="POST">
    @csrf
    <input type="text" name="title" placeholder="Tambah todo">
    <button type="submit">Tambah</button>
</form>

<hr>

@foreach($todos as $todo)
    <div>
        <form action="{{ route('todos.update', $todo->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('PUT')
            <button type="submit">
                {{ $todo->is_completed ? '✅' : '⬜' }}
            </button>
        </form>

        {{ $todo->title }}

        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">❌</button>
        </form>
    </div>
@endforeach

</body>
</html>