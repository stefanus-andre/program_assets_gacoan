<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/css/login.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <title>ASMI - Asset System Management Integration</title>
</head>
<body>
    <div class="parent-container">
        <div class="card">
            <div class="card-header">
                <img src="{{asset('assets/images/header-card.png')}}" class="header-card-image">
            </div>
            <p><h5><b>Sign In</b></h5></p>
            <div class="card-body">
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="container">
                        <label for="username"><h6>NIK (Nomor Induk Karyawan) : </h6></label>
                        <br>
                        <input type="text" name="username" id="username" class="form-control col-xs-2" placeholder="Masukkan NIK Anda...." required>
                        <br>
                        <label class="form-label"><h6>Password : </h6></label>
                        <div class="input-group mb-3">
                            <input class="form-control password" id="password" class="block mt-1 w-full" type="password" name="password" placeholder="Masukkan Password Anda..." required />
                            <span class="input-group-text togglePassword" id="">
                                <i data-feather="eye" style="cursor: pointer"></i>
                            </span>
                        </div> 
                        <!-- <a href="#" class="lupa-password">Lupa Password?</a> -->
                    </div>
                    <div class="button-container">
                        <button type="submit" class="btn btn-primary btn-md">Submit</button>
                    </div>
                </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/password-visible.js')}}">

    </script>
</body>
</html>