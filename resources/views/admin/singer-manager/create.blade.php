@extends('master.master')
@section('title','Add Singer')
@section('content')
    <form>
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" id="name_singer" style="width: 30%">
        </div>
        <button type="submit" id="submitButton" class="btn btn-primary">Submit</button>
    </form>
    <script src="{{asset('jquery/jqueryCreateSinger.js')}}"></script>
@endsection
