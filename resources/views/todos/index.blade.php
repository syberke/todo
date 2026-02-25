<!DOCTYPE html>
<html>
<head>
    <title>Todo App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex justify-center items-start p-10">

<div class="bg-white shadow-xl rounded-2xl p-8 w-full max-w-2xl">

    <h1 class="text-3xl font-bold mb-6 text-center">🚀 Todo App</h1>

    <!-- Search & Filter -->
    <form method="GET" class="flex gap-2 mb-4">
        <input 
            type="text" 
            name="search" 
            placeholder="Search todo..."
            value="{{ request('search') }}"
            class="flex-1 border rounded-lg px-3 py-2"
        >

        <select name="status" class="border rounded-lg px-3 py-2">
            <option value="">All</option>
            <option value="completed" {{ request('status')=='completed'?'selected':'' }}>Completed</option>
            <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
        </select>

        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">
            Search
        </button>
    </form>

    <!-- Add Todo -->
    <form action="{{ route('todos.store') }}" method="POST" class="flex gap-2 mb-6">
        @csrf
        <input 
            type="text" 
            name="title" 
            placeholder="Tambah todo..."
            class="flex-1 border rounded-lg px-3 py-2"
        >
        <button class="bg-green-500 text-white px-4 py-2 rounded-lg">
            Tambah
        </button>
    </form>

    <!-- Todo List -->
    <div class="space-y-3">
        @forelse($todos as $todo)
            <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg shadow">

                <form action="{{ route('todos.update', $todo->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="text-xl">
                        {{ $todo->is_completed ? '✅' : '⬜' }}
                    </button>
                </form>

                <span class="flex-1 ml-3 {{ $todo->is_completed ? 'line-through text-gray-400' : '' }}">
                    {{ $todo->title }}
                </span>

                <form action="{{ route('todos.destroy', $todo->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500">❌</button>
                </form>

            </div>
        @empty
            <p class="text-center text-gray-500">Tidak ada todo.</p>
        @endforelse
    </div>

</div>

</body>
</html>