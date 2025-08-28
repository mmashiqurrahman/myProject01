<div>
    <h4>Welcome!</h4>
    <hr>
    <p id="red34"></p>
    <p>Your email: <span id="red35"></span></p>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const access_token = localStorage.getItem('access_token');
        console.log(access_token);

        $.ajax({
            url: 'http://localhost:8000/api/profile-info',
            type: 'GET',
            headers: {
                'Authorization': 'Bearer ' + access_token
            },
            success: function(response) {
                console.log(response);
                $('#red34').text(response.name);
                $('#red35').text(response.email);
            },
            error: function(error){
                console.log(error);
            }
        });
    });
</script>