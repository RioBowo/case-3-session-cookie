<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- SweetAlert2 library -->
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Please Login</h2>
                        <form id="loginForm" action="check_login.php" method="post">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember Me</label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            // Check if email cookie exists and set it to the input field
            var rememberedEmail = getCookie('rememberedEmail');
            if (rememberedEmail !== "") {
                $("#email").val(rememberedEmail);
                $("#rememberMe").prop('checked', true);
            }

            $("#loginForm").submit(function(event){
                event.preventDefault(); // Prevent default form submission
                var email = $("#email").val();
                var password = $("#password").val();
                var rememberMe = $("#rememberMe").is(':checked');

                // Submit form via AJAX
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response == "success") {
                            // If Remember Me is checked, save email in cookie for 24 hours
                            if (rememberMe) {
                                var d = new Date();
                                d.setTime(d.getTime() + (24*60*60*1000)); // 24 hours
                                var expires = "expires=" + d.toUTCString();
                                document.cookie = "rememberedEmail=" + email + ";" + expires + ";path=/";
                            } else {
                                // If Remember Me is not checked, clear the email cookie
                                document.cookie = "rememberedEmail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                            }
                            window.location.href = "profile.php"; // Redirect to profile page
                        } else {
                            // Show error message using SweetAlert2
                            Swal.fire({
                                icon: 'error',
                                title: 'Email atau password tidak valid',
                                text: 'Masukkan email dan password yang benar!',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                });
            });
        });

        // Function to get cookie value by name
        function getCookie(cookieName) {
            var name = cookieName + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var cookieArray = decodedCookie.split(';');
            for(var i = 0; i <cookieArray.length; i++) {
                var cookie = cookieArray[i];
                while (cookie.charAt(0) == ' ') {
                    cookie = cookie.substring(1);
                }
                if (cookie.indexOf(name) == 0) {
                    return cookie.substring(name.length, cookie.length);
                }
            }
            return "";
        }
    </script>
</body>
</html>
