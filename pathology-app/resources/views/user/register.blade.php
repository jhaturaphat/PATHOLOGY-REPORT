@extends('user.layout')

@section('content')

<div class="container">
    <div class="pt-5">
        <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
            @if (session()->has('danger'))
                <div class="alert alert-danger">
                    {{ session('danger') }}
                </div>
            @endif
        </div>
        <div class="card mx-auto" style="width: 480px">
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3 row">
                        <label for="inputName" class="col-sm-3 col-form-label">ชือ-สกุล</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="inputName" name="name">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                        <input type="email" class="form-control" id="staticEmail" name="email">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                        <input type="password" class="form-control" id="inputPassword" name="password">
                        </div>
                    </div>
                    <div class="col-md-12 d-flex flex-row justify-content-end">
                        <a class="me-3" href="{{route('home')}}">HOME</a>
                        <button type="submit" class="btn btn-primary">REGISTER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection
