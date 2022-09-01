<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form class="form-login" action="#">
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password">
                            </div>
                        </div>



                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="submit">
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content'),
            }
        });

        $(".form-login").submit(function() {
            email = $("#email").val();
            password = $("#password").val();
            $.ajax({
                type: 'POST',
                data: {
                    'email': email,
                    'password': password
                },
                url: 'http://localhost:8000/api/users/login',
                dataType: 'json',
                success: function(data) {
                    // console.log(data.conntent.api_token);

                    // console.log(data);

                    if (data.response_code == 404) {
                        alert(data.message);
                    } else {

                        localStorage.setItem("api_token", data.conntent.api_token);
                        $(".uk").show();
                        $(".kr").show();
                        $(".lg").show();

                        // // window.location = '/home';
                        $(".py-4").load('/dashboard');
                    }


                },
                error: function(status, data) {
                    console.log(data);
                    // alert(data);
                }
            });
            return false;
        });
    });
</script>