<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>
    <div class="messages" style="max-width: 400px;">
        <div class="top">
            <div>
                <a class="navbar-brand" href="/">CompanyLogo</a>
            </div>
        </div>
        <br><hr>
        <div class="message">
            <p>Channel Name: {{ $channelname }}</p>
            <p>FromUserId: {{ $fromuser }}</p>
            <p>ToUserId: {{ $touser }}</p> <br>
            <p>Here are the messages.</p>
        </div>
        @foreach($texts as $text)
            <div class="message">
                @if($you->id == $text->fromuser)
                    <p style="text-align: right; background-color: #99ffff; padding: 5px;"><b>You</b>: {{ $text->content }}</p>
                @else
                   <p style="background-color: #ffff99; padding: 5px;"><b>{{ $oppositeParty->name }}</b>: {{ $text->content }}</p>
                @endif
            </div>
        @endforeach
        <div class="bottom">
            <form>
                <input type="text" id="message" name="message" placeholder="Enter message..." autocomplete="off">
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
</body>
<script>
    const pusher = new Pusher("{{ config('broadcasting.connections.pusher.key') }}", {
        cluster: 'eu',
        authEndpoint: '/broadcasting/auth', // Laravel default auth route
        auth: {
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}", // Include CSRF token for Laravel authentication
            }
        }
    });
    console.log('private-{{ $channelname }}');
    const channel = pusher.subscribe('private-{{ $channelname }}');

    channel.bind('chat', function (data) {
        console.log('Event fired and received from Pusher.');
        console.log(data);
        $.post("/receive", {
            _token: '{{ csrf_token() }}',
            message: data.message,
            user_name: data.user_name,
        })
            .done(function (res) {
                $(".messages > .message").last().after(res);
                $(document).scrollTop($(document).height());
            });
    });

    $("form").submit(function (event) {
        event.preventDefault();

        $.ajax({
            url: "/broadcast",
            method: "POST",
            headers: {
                'X-Socket-Id' : pusher.connection.socket_id
            },
            data: {
                _token: '{{ csrf_token() }}',
                message: $("form input[name='message']").val(),
                user_name: '{{ Auth::user()->name }}',
                channelname: '{{ $channelname }}',
                fromuser: '{{ $fromuser }}',
                touser: '{{ $touser }}',
            }
        }).done(function (res) {
            $(".messages > .message").last().after(res);
            $("form input[name='message']").val('');
            $(document).scrollTop($(document).height());
        });
    });
</script>
</html>
