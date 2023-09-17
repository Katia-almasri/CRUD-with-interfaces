<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->

    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- <link href="{{ asset('css/styles.css') }}" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
</head>

<body>
    <div class="alert-container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    </div>

    <div class="container">

        <div class="cover">
            <div class="front">
                <img src="{{ asset('assets/Images/frontImg.jpg') }}" alt="">


            </div>
            <div class="back">
                <img class="backImg" src="images/backImg.jpg" alt="">
                <div class="text">
                    <span class="text-1">Complete miles of journey <br> with one step</span>
                    <span class="text-2">Let's get started</span>
                </div>
            </div>
        </div>


        <div class="forms">
            <div class="form-content justify-content-right">
                <div class="signup-form">
                    <div class="title">Signup</div>
                    <form action="{{ route('registerData') }}" method="post">
                        @csrf
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input type="text" name="name" placeholder="Enter your name" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="text" name="email" placeholder="Enter your email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="password" name="password" placeholder="Enter your password" required>
                            </div>

                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input type="password" name="password_confirmation" placeholder="confirm your password"
                                    required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Sumbit">
                            </div>
                            <div class="text sign-up-text">Already have an account? <a href="{{ route('login') }}">Login
                                    now</a> <label for="flip"></label></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
