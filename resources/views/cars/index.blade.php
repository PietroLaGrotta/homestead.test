@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>Inventario automobili</h1></div>

                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <button onclick="window.location.href='/cars/0/template'" class="btn btn-primary">Nuova Automobile</button>
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
                 <th>Matricola</th>
                 <th>Prezzo</th>
                 <th>Immatricolazione</th>
                 <th>Chilometri</th>
                 <th>Created at</th>
                 <td colspan="2"><strong>Action</strong></td>
              </tr>
           </thead>
           <tbody>
              @foreach($goods as $good)
                
                    <tr>
                       <td>{{ $good->id }}</td>
                       <td>{{ ($good->status) ? "Visibile" : "Nascosto" }}</td>
                       <td>{{ $good->title }}</td>
                       <td>{{ $good->group_title }}</td>
                       <td>{{ $good->registration_number }}</td>
                       <td>{{ $good->price }}</td>
                       <td>{{ $good->registration_year }}</td>
                       <td>{{ $good->kilometres }}</td>
                       <td>{{ date('d/m/Y', strtotime($good->created_at)) }}</td>
                       
                       <td><a href="{{ url('/cars/' . $good->id . '/template') }}" class="btn btn-primary">Edit</a></td>
                       
                       <td>
                       <form action="{{ route('cars.destroy', $good->id)}}" method="post">
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
