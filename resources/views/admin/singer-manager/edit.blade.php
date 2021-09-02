@extends('master.master')
@section('title','List Singer')
@section('content')
    <form method="post" action="{{route('update',$singer->id)}}">
        @csrf
        <input type="text" name="name" value="{{$singer->name}}" id="">
        <input type="submit">
    </form>
@endsection
