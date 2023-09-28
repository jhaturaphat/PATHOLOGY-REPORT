@extends('user.layout')
@section('content')

<div class="container d-flex flex-column justify-content-center align-items-center">
    <div class="pt-5">
        <div class="card mx-auto" style="width: 480px">
            <div class="card-body">
                <form method="POST" action="{{ route('change.password') }}">
                    @csrf
                    <div class="mb-3 row">
                        <label for="password" class="col-sm-3 col-form-label">รหัสผ่านเดิม</label>
                        <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password" >
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="new_password" class="col-sm-3 col-form-label">รหัสผ่านใหม่</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="new_password" name="new_password" >
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="confirm_password" class="col-sm-3 col-form-label">ยืนยันรหัสผ่านใหม่</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" id="confirm_password" name="confirm_password">
                        </div>
                    </div>
                    <div class="col-md-12 d-flex flex-row justify-content-end">
                        <button type="submit" class="btn btn-primary">เปลี่ยนรหัสผ่าน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection