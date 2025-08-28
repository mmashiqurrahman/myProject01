<form id="loginForm">
    <input type="email" id="email" name="email" placeholder="email">
    <input type="password" id="password" name="password" placeholder="password">
    <button type="submit">Login</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function (e) {
            e.preventDefault();  
            
            const email = $('#email').val();
            const password = $('#password').val();
            console.log('email: ' + email + ', password: ' + password);

            $.ajax({
                url: 'http://localhost:8000/api/login',
                type: 'POST',
                data: {
                    email: email,
                    password: password
                },
                success: function(response) {
                    localStorage.setItem('access_token', response.access_token);
                    window.location.href = '/api-dashboard';
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>