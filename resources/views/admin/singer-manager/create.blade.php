@extends('master.master')
@section('title','Add Singer')
@section('content')
    <form action="" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name" style="width: 30%">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
