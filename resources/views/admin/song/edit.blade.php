@extends('master.master')
@section('title','add song')
@section('content')
    <form action="{{route('song.update',$song->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <legend>Add</legend>
        <div class="mb-3">
            <label  class="form-label">Ten bai hat</label>
            <input type="text"  value="{{$song->song_name}}" class="form-control" name="name">
        </div>
        <div class="mb-3">
            <label  class="form-label">Ca si</label>
            <select name="singer" class="form-select">
                @foreach($singers as $singer)
                    <option value="{{$singer->id}}">{{$singer->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label  class="form-label">anh</label>
            <input type="file" value="{{$song->song_image}}" class="form-control" name="image">
        </div>
        <div class="mb-3">
            <label  class="form-label">bai hat</label>
            <input type="file" value="{{$song->path}}" class="form-control" name="song">
        </div>
        <button type="submit" class="btn btn-primary">add</button>
        <a href="{{route('song.list')}}"class="btn btn-outline-primary">back</a>

    </form>
@endsection

