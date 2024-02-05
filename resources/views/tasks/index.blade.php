@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Task List</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Assigned To</th>
                    <th>Assigned By</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{{ $task->assignedTo->name }}</td>
                        <td>{{ $task->assignedBy->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $tasks->links() }} <!-- Pagination links -->

    </div>
@endsection
