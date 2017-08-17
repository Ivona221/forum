@foreach($responses as $response)
    {{-- show the comment markup --}}
   {{$response->body}} {{$response->discussion->id}}
    @if($response->responses())
        {{-- recursively include this view, passing in the new collection of comments to iterate --}}
        @include('forum.partials.show', ['responses' => $response->responses])
    @endif
@endforeach



