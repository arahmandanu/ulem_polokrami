@extends('admin.shared.main')
{{-- Assuming you have a main layout file --}}

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Comments Management</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">From</th>
                    <th scope="col">Comment Text</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($comments as $comment)
                    <tr>
                        <th scope="row">{{ $comment->id }}</th>
                        <td>{{ $comment->from }}</td>
                        <td>{{ Str::limit($comment->text, 50) }}</td> {{-- Limit text for display --}}
                        <td>
                            <span class="badge {{ $comment->show ? 'bg-success' : 'bg-danger' }}">
                                {{ $comment->show ? 'Shown' : 'Hidden' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-sm btn-primary me-2">
                                Edit
                            </a>

                            {{-- Form to quickly toggle the 'show' status --}}
                            <form action="{{ route('comments.update', $comment->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="toggle_show" value="{{ $comment->show ? 0 : 1 }}">
                                <button type="submit"
                                    class="btn btn-sm {{ $comment->show ? 'btn-warning' : 'btn-success' }}">
                                    {{ $comment->show ? 'Hide' : 'Show' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No comments found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $comments->links() }} {{-- Add pagination links --}}
    </div>
@endsection
