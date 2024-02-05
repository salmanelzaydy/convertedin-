@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Task Statistics</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Task Count</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topUsers as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->assigned_tasks_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
