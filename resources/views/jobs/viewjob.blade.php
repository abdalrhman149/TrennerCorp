@extends('master')

@section('content1')
<div class="container mt-4">
    <h2 class="mb-4">Job List</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-success">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Category</th>
                <th>Requirements</th>
                <th>Persons Needed</th>
                <th>Company</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($alljob as $job)
                <tr>
                    <td>{{ $job->id }}</td>
                    <td>{{ $job->title }}</td>
                    <td>{{ $job->category }}</td>
                    <td>{{ $job->requirements }}</td>
                    <td>{{ $job->person_need }}</td>
                    <td>{{ $job->company ? $job->company->name : '—' }}</td>
                    <td>{{ $job->created_at }}</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-info">View</a>
                        <a href="#" class="btn btn-sm btn-warning">Edit</a>
                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this job?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No jobs found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
