
@extends('pathology-a.layout')

@section('title', 'หน้าแรกสุด')

@section('content')
<br>
<table class="table table-primary table-hover">
    <thead>
        <tr>
            <th title="รหัส out lab">OUT ID</th>
            <th title="รหัส lab_order_number">IN ID</th>
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
            <td style="display: flex">
                {{-- <form action="pathology-a.edit/{{$item->id}}"></form> --}}
                <a href="{{route('pathology-a.edit',[$item->id])}}">แก้ไข</a>                
                <form action="{{route('delete',$item->id)}}" method="POST">
                    @method('delete')
                    @csrf
                    <input type="submit" value="ลบ">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>

@endsection