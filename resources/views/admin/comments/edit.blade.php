@extends('admin.shared.main')
{{-- Assuming you have a main layout file --}}

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Comment #{{ $comment->id }}</h1>

        {{-- Form for updating the comment --}}
        <form action="{{ route('comments.update', $comment->id) }}" method="POST">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- From Field --}}
            <div class="mb-3">
                <label for="from" class="form-label">Sender Name (From)</label>
                <input type="text" class="form-control" id="from" name="from"
                    value="{{ old('from', $comment->from) }}" required>
            </div>

            {{-- Text Field --}}
            <div class="mb-3">
                <label for="text" class="form-label">Comment Text</label>
                <textarea class="form-control" id="text" name="text" rows="5" required>{{ old('text', $comment->text) }}</textarea>
            </div>

            {{-- Show/Hide Status --}}
            <div class="mb-3 form-check form-switch">
                <input class="form-check-input" type="checkbox" role="switch" id="show" name="show" value="1"
                    {{ old('show', $comment->show) ? 'checked' : '' }}>
                <label class="form-check-label" for="show">Display Comment Publicly</label>
                <small class="text-muted d-block">If unchecked, the comment will be hidden from the public view.</small>
            </div>

            <button type="submit" class="btn btn-success">Update Comment</button>
            <a href="{{ route('comments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
