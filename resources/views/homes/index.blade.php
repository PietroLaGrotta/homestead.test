@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>Inventario case</h1></div>

                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <button onclick="window.location.href='/homes/0/template'" class="btn btn-primary">Nuova Casa</button>
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered" id="laravel_crud"> 
           <thead>
              <tr>
                 <th>Id</th>
                 <th>Stato</th>
                 <th>Titolo</th>
                 <th>Gruppo</th>
                 <th>Description</th>
                 <th>Codice Immobile</th>
                 <th>Prezzo</th>
                 <th>Created at</th>
                 <td colspan="2"><strong>Action</strong></td>
              </tr>
           </thead>
           <tbody>
              @foreach($goods as $good)
                
                    <tr>
                       <td>{{ $good->id }}</td>
                       <td>{{ ($good->visible) ? "Visibile" : "Nascosto" }}</td>
                       <td>{{ $good->title }}</td>
                       <td>{{ $good->group_title }}</td>
                       <td>{{ $good->description }}</td>
                       <td>{{ $good->property_code }}</td>
                       <td>{{ $good->price }}</td>
                       <td>{{ date('d/m/Y', strtotime($good->created_at)) }}</td>
                       
                       <td><a href="{{ url('/homes/' . $good->id . '/template') }}" class="btn btn-primary">Edit</a></td>
                       
                       <td>
                       <form action="{{ route('homes.destroy', $good->id)}}" method="post">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                      </form>
                      </td>
                    </tr>
                
              @endforeach
           </tbody>
          </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
