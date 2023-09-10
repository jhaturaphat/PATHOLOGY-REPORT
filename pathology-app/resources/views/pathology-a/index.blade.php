
@extends('pathology-a.layout')

@section('title', 'หน้าแรกสุด')

@section('content')
<br>
<table class="table table-primary table-hover">
    <thead>
        <tr>
            <th>lab_order</th>
            <th>HN</th>
            <th>ชื่อ</th>
            <th>สกุล</th>
            <th witdh="280px">วันที่สั่ง</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($model as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td>{{$item->hn}}</td>
            <td>{{$item->fname}}</td>
            <td>{{$item->lname}}</td>
            <td>{{$item->created_at}}</td>
            <td>
                {{-- <form action="pathology-a.edit/{{$item->id}}"></form> --}}
                <a href="{{route('pathology-a.edit',$item->id)}}">แก้ไข</a>
                <a href="/pathology-a/delete">ลบ</a>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

@endsection