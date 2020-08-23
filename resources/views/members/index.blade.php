@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>Membri del gruppo {{$group->title}}</h1></div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-md-12">
                            <button onclick="window.location.href = '/groups'" class="btn btn-primary">Torna alla lista dei gruppi</button>
                        </div>
                    </div>
                    <br>
                    <table class="table table-bordered" id="laravel_crud">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>App Prodotti</th>
                                <th>App Case</th>
                                <th>App Auto</th>
                                <th>Created at</th>
                                <td colspan="1"><strong>Actions</strong></td>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach( $members as $member )
                            <tr>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->email }}</td>

                                <td>
                        <app-abled-component 
                            app="products" 
                            checked="{{ $member->product_abled }}" 
                            memberid="{{ $member->id }}"/>
                        </td>

                        <td>
                        <app-abled-component 
                            app="homes" 
                            checked="{{ $member->home_abled }}" 
                            memberid="{{ $member->id }}"/>
                        </td>

                        <td>
                        <app-abled-component 
                            app="cars" 
                            checked="{{ $member->car_abled }}" 
                            memberid="{{ $member->id }}"/>
                        </td>


                        <td>{{ date('d/m/Y', strtotime($member->created_at)) }}</td>

                        <td>

                            <form action="{{ route('members.destroy', $member->id)}}" method="post">
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
        
        <div class="col-md-12" style="margin-top:40px;">
            <div class="card">
                <div class="card-header"><h1>Aggiungi altri utenti al gruppo {{$group->title}}</h1></div>

                <div class="card-body">

                    <table class="table table-bordered" id="laravel_crud">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach( $users as $user )
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ date('d/m/Y', strtotime($member->created_at)) }}</td>

                                <td>
                                    <form action="/members" method="post" name="{{$user->email}}">
                                        {{ csrf_field() }}
                                        @method('POST')
                                        <input type="hidden" name="groupid" value="{{$group->id}}">
                                        <input type="hidden" name="userid" value="{{$user->id}}">
                                        <button class="btn btn-primary" type="submit">Aggiungi</button>
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
