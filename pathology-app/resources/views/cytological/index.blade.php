
@extends('cytological.layout')

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
            <td>{{$item->outid}}</td>
            <td>{{$item->lab_order_number}}</td>
            <td>{{$item->hn}}</td>
            <td>{{$item->fname}}</td>
            <td>{{$item->lname}}</td>
            <td>{{$item->created_at}}</td>
            <td>{{$item->release}}</td>
            <td class="cmd-action">
                @if ($item->release !== "P")
                {{-- ตรวจสอบ ชนิดผลตรวจว่าเป็น  CYTOLOGICAL หรือ SURGICAL ก่อนส่งข้อมูลไป update ที่ controller--}}
                    @if($item->type === "CYTOLOGICAL")
                    <a href="{{route('cytological.edit',[$item->id])}}">แก้ไข</a>   
                    @elseif ($item->type === "SURGICAL")
                    <a href="{{route('surgical.edit',[$item->id])}}">แก้ไข</a>
                    @endif
                @else
                    <a href="javascript:void(0)" style="cursor: not-allowed; color:rgb(161, 164, 164)">แก้ไข</a>   
                @endif               

                {{-- ตรวจสอบ ชนิดผลตรวจว่าเป็น  CYTOLOGICAL หรือ SURGICAL ก่อนส่งข้อมูลไป update ที่ controller--}}
                @if($item->type === "CYTOLOGICAL")
                <form action="{{route('cyt.confirm',$item->id)}}" method="POST">
                @elseif ($item->type === "SURGICAL")
                <form action="{{route('sur.confirm',$item->id)}}" method="POST">
                @endif
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