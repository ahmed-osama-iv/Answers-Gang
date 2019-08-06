@extends('layouts/master')

@section('content')

<form method="post" action="/groups/update">
    @method('put')
    @csrf
    <input type="hidden" name="id" value="{{$group->id}}">
    <input type="text" name="name" value="{{$group->name}}">
    <input type="text" name="description" value="{{$group->description}}">
    <input type="submit" value="Save">
</form>

@endsection