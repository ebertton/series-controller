@extends('layout')
@section('header')       
    Series
@endsection
@section('content')
@if(isset($message))   
    <div class="alert alert-success">
        {{ $message }}    
    </div>
@endif    
    <a href="{{ route('form_create_series') }}" class="btn btn-dark mb-2">Add</a>
    <ul class="list-group">
       @foreach($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">

                <span id="name-series-{{ $serie->id }}">{{ $serie->name }}</span>
                <div class="input-group w-50" hidden id="input-name-series-{{ $serie->id }}">
                    <input type="text" class="form-control" value="{{ $serie->name }}">
                    <div class="input-griup-append">
                        @auth
                        <button class="btn btn-primary" onclick="editSeries({{ $serie->id }})">
                            <i class="fa fa-check"></i>
                        </button>
                        @endauth
                        
                        @csrf
                    </div>
                </div> 

                <span class="d-flex">
                    @auth
                    <button class="btn btn-info btn-sm mr-1" onclick="toggleInput({{$serie->id}})">
                        <i class="fa fa-edit"></i>
                    </button>
                    @endauth
                    <a href="/series/{{ $serie->id }}/seasons" class="btn btn-info btn-sm mr-1">
                        <i class="fa fa-external-link"></i>
                    </a>
                    @auth
                    <form method="post" action="/series/{{ $serie->id }}" 
                        onsubmit="return confirm('Are you sure that you want remove the series {{ addslashes($serie->name) }}?')" >
                        @csrf
                        @method('DELETE') 
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    </form>
                    @endauth
                </span>
            </li>
       @endforeach
    </ul>
    <script>
        function toggleInput(serieId){
            
            const nameSeriesEl = document.getElementById(`name-series-${serieId}`);
            const inputSeriesEl =  document.getElementById(`input-name-series-${serieId}`);
            
            if (nameSeriesEl.hasAttribute('hidden')){
                
                nameSeriesEl.removeAttribute('hidden');
                inputSeriesEl.hidden = true;

            } else{
                inputSeriesEl.removeAttribute('hidden');
                nameSeriesEl.hidden = true;
            } 
        }

        function editSeries(serieId) {
            let formData = new FormData();
            const name = document.querySelector(`#input-name-series-${serieId} > input`).value;
            const token = document.querySelector(`input[name="_token"]`).value;
            formData.append('name', name);
            formData.append('_token', token);
            const url = `/series/${serieId}/editName`;
            fetch(url, {
                method: 'POST',
                body: formData
            }).then(() => {
                toggleInput(serieId);
                document.getElementById(`name-series-${serieId}`).textContent = name;
            });
        }


        
    </script>
@endsection
 