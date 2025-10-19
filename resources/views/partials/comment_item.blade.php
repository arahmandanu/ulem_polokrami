<div class="border rounded p-3 mb-3 bg-light">
    <strong>{{ $comment->from }}</strong>
    <p class="mb-0 mt-1">{{ $comment->text }}</p>
    <small class="text-muted d-block text-end">
        {{ $comment->created_at?->diffForHumans() }}
    </small>
</div>
