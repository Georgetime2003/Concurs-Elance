@extends('header')
@section('content')
<main class="bg-image">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card border-0 shadow rounded-3 my-5">
                        <div class="card-body p-4 p-sm-5">
                            <img src="{{asset('logo.png')}}" alt="logo" class="rounded mx-auto d-block" style="width: 75%; height: auto;">
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{session('error')}}
                                </div>
                            @endif
                                <form action="{{route('login')}}" method="POST" class="form-signin">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingInput" name="name" placeholder="name@example.com" require>
                                        <label for="floatingInput">Usuari</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" require>
                                        <label for="floatingPassword">Contrasenya</label>
                                    </div>
                                    <div class="d-grid text-center">
                                        <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2" name="logStandard" type="submit">Accedeix</button>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection

{{-- @extends('layout')
{{--     <form action="{{route('participacions')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form> --}}