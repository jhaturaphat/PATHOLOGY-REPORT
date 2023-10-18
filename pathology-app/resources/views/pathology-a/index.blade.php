
@extends('pathology-a.layout')

@section('title', 'หน้าแรกสุด')

@section('content')
<br>
<div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
@if (session()->has('success'))
    <div class="alert alert-success" >
        {{ session('success') }}
    </div>
@endif
</div>
<div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 3000)">
@if (session()->has('danger'))
    <div class="alert alert-danger">
        {{ session('danger') }}
    </div>
@endif
</div>

<div>      
</div>

<table class="table table-primary table-hover">
    <thead>
        <tr>
            <th title="รหัส Surgical number">Surgical number</th>
            <th title="รหัส lab_order_number">lab order number</th>
            <th>HN</th>
            <th>ชื่อ</th>
            <th>สกุล</th>
            <th witdh="">วันที่สั่ง</th>
            <th>สถานะ</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>        
        @foreach ($model as $item)        
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->lab_order_number}}</td>
            <td>{{$item->hn}}</td>
            <td>{{$item->fname}}</td>
            <td>{{$item->lname}}</td>
            <td>{{$item->created_at}}</td>
            <td>{{$item->release}}</td>
            <td>
                @if ($item->release !== "P")
                    <a href="{{route('pathology-a.edit',[$item->id])}}">แก้ไข</a>   
                    @else
                    <a href="javascript:void(0)" style="cursor: not-allowed; color:rgb(161, 164, 164)">แก้ไข</a>   
                    @endif
                {{-- <form action="{{route('delete',$item->id)}}" method="POST">
                    @method('delete')
                    @csrf
                    @if ($item->release !== "P")
                    <input type="submit" value="ลบ">
                    @else
                    <input type="submit" value="ลบ" disabled>
                    @endif
                </form> --}}
                <form action="{{route('release',$item->id)}}" method="POST">
                    @method('PATCH')
                    @csrf
                    @if ($item->release !== "P")
                    <input type="submit" value="ยืนยันผล" >
                    @else
                    <input type="button" value="ยืนยันผล" disabled >
                    @endif
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection