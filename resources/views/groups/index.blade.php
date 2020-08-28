@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>Gruppi di {{ $user->name }} </h1></div>

                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-12">
                            <button onclick="window.location.href='/groups/0/template'" class="btn btn-primary">Nuovo Gruppo</button>
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered" id="laravel_crud">
           <thead>
              <tr>
                 <th>Id</th>
                 <th>Proprietario</th>
                 <th>Stato</th>
                 <th>Title</th>
                 <th>Description</th>
                 <th>Created at</th>
                 <td colspan="3"><strong>Action</strong></td>
              </tr>
           </thead>
           <tbody>
              @foreach($groups as $group)
                @if (($group->howner_id == $user->id) || $group->status)
                    <tr>
                       <td>{{ $group->id }}</td>
                       <td>{{ ($group->howner_id == $user->id) ? "Si" : "No" }}</td>
                       <td>{{ ($group->status) ? "Visibile" : "Nascosto" }}</td>
                       <td>{{ $group->title }}</td>
                       <td>{{ $group->description }}</td>
                       <td>{{ date('d/m/Y', strtotime($group->created_at)) }}</td>
                       
                       <td><a href="{{ url('/groups/' . $group->id . '/template') }}" class="btn btn-primary">Edit</a></td>
                       <td><a href="{{ url('/members/' . $group->id . '/index' ) }}" class="btn btn-primary">Members</a></td> 
                       <td>
                       <form action="{{ route('groups.destroy', $group->id)}}" method="post">
                        {{ csrf_field() }}
                        @method('DELETE')
                        <button class="btn btn-danger" type="submit">Delete</button>
                      </form>
                      </td>
                    </tr>
                @endif
              @endforeach
           </tbody>
          </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
