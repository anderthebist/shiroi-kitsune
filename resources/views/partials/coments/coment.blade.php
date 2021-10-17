@include('partials.coments.coment_item', ['comment' => $comment])

<div class="answer" id = "answer{{ $comment->id }}" data-answer="{{ $comment->id }}">
    @each('partials.coments.coment_item', $comment->answers, 'comment')
</div>