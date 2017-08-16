<div class="comment">
    <div class="comment-author">{{ $response->user->name }}</div>
    <div class="comment-body">{{ $response->id }}  {{ $response->body }} {{ $response->parent_id }}  {{ $response->discussion_id }}</div>
    <div class="comment-replies">
        <!-- style of this div is indented to look nested -->
        @each('forum.partials.single', $response->responses, 'response')
    </div>
</div>