@foreach ($comments as $comment)
    {{-- $comments is the collection passed from the controller --}}
    {{-- $comment is the single item in the current iteration --}}
    @include('partials.comment_item', ['comment' => $comment])
@endforeach
