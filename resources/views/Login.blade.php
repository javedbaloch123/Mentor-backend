<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">


        <div class="row">
            <div class="col-xl-6 mx-auto mt-4">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Login</h5>
                        <form class="row g-3" id="loginForm" name="loginForm">
                            @csrf
                            <div class="col-md-12">
                                <label for="input4" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email">
                                    <p></p>
                            </div>
                               <div class="col-md-12">
                                <label for="input4" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password"
                                    placeholder="password">
                                    <p></p>
                            </div>
                            <div class="col-md-12">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    	<script src="{{ asset("assets/js/jquery.min.js") }}"></script>

        <script>
            $("#loginForm").submit((e)=>{
                e.preventDefault();

                $.ajax({
                    url: "{{ route('process.login') }}",
                    type:'post',
                    data:$('#loginForm').serialize(),
                    dataType: 'json',
                    success:function(response){
                        console.log(response);
                         if (response.status === false) {

                        let errors = response.error;
                        let keys = ['email', 'password'];
                        keys.forEach(element => {
                            $(`#${element}`).removeClass('is-invalid');
                            $(`#${element}`).next('p').text('');
                        });

                        for (let key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                // Add is-invalid class
                             
                                $(`#${key}`).addClass('is-invalid');
                                $(`#${key}`).next('p').text(errors[key][0]).css('color', 'red');

                            }
                        }
                    } else {
                            
                        window.location.href = '{{ route("admin.pannel") }}';
                    }
                    }
                })
            })
        </script>
</body>

</html>
