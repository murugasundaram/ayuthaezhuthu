@if(Session::has('flash_message'))
    <p class = "container alert alert-{!! session('flash_message_class') !!}"> {!! session('flash_message') !!} </p>
@endif
@if (count($errors) > 0)
    <div class="alert alert-danger container">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
