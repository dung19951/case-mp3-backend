@extends('master.master')
@section('title','List Song')
@section('content')
    <div class="container"><a href="{{route('song.add')}}" class="btn-success">add song</a></div>
    <table class="table table-striped">
        <tr>
            <th>#</th>
            <th>Song</th>
            <th>Image</th>
            <th>Singer</th>
            <th>Action</th>
        </tr>
        @foreach($songs as $song)
            <tr>
                <td>{{$song->id}}</td>
                <td><audio controls autoplay src="{{$song->path}}" type="audio/mpeg"></audio>{{$song->song_name}}</td>
                <td><img src="{{ asset('storage/'.$song->song_image) }}" alt="" style="width: 100px; height: 100px"></td>
                <td>@if(isset($song->singer)){{$song->singer->name}}@endif</td>
                <td><a href="{{route('song.edit',$song->id)}}" class="btn btn-outline-primary">sua</a></td>
                <td><a href="{{route('song.delete',$song->id)}}" class="btn btn-danger" onclick="return confirm('ban co chac chan muon xoa')">xoa</a></td>

            </tr>
        @endforeach
    </table>
@endsection
