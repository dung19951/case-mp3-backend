@extends('master.master')
@section('title','Add Singer')
@section('content')
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Singer Name</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
