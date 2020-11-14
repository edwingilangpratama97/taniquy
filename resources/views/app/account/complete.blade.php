@include('app.layouts.header')

<body>
    <div id="auth">        
    <div class="container">
        <div class="auth-logo">  
            <img src="{{asset('images/logo.png')}}" height="100" class='mb-4'><br>
            <h5 class="py-2">Mohon Lengkapi Data Diri Anda</h5>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 mx-auto">
                <form method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="email-column">Email</label>
                                <input id="email-column" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="password-column">Password</label>
                                <input id="password-column" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </diV>
                    Belum punya akun? <a href="{{route('register')}}">Registrasi</a>
                    <div class="clearfix mt-3">
                        <button class="btn btn-success float-right">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('app.layouts.footer')
</body>

</html>