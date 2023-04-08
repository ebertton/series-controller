@extends('layout')

@section('header')
Add Series
@endsection

@section('content')
@include('error', ['errors' => $errors])
<form action="/series/save" method="post">
    @csrf
    <div class="row">
        <div class="col col-8">
            <label for="name">Name</label>
            <input id="number" type="text" class="form-control" name="name" />
        </div>
        <div class="col col-2">
            <label for="season_number">Seasons number</label>
            <input id="season_number" type="text" class="form-control" name="season_number" />
        </div>
        <div class="col col-2">
            <label for="ep_season">Ep season</label>
            <input id="ep_season" type="number" class="form-control" name="ep_season" />
        </div>
    </div>
    <button class="btn btn-primary mt-2">Add</button>
</form>
@endsection