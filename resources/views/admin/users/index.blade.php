@extends('layouts.admin')

@section('title',"Пользователи")

@section('styles')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
    <section class="content admin_content pb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Картинка</th>
                                <th rowspan="1" colspan="1">Имя</th>
                                <th rowspan="1" colspan="1">Статус</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="odd">
                                    <td>
                                        <a href="{{route("users.show", ["user"=> $user->name])}}">
                                            {{ $user->id }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route("users.show", ["user"=> $user->name])}}">
                                            <img src="{{$user->image ? asset("/images/users/".$user->image) 
                                            : asset("/images/users/default-user-image.png")}}" style="max-width: 75px" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route("users.show", ["user"=> $user->name])}}">
                                            {{ $user->name }}
                                        </a>
                                    </td>
                                    <td>
                                        {{ $user->status }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Картинка</th>
                                <th rowspan="1" colspan="1">Имя</th>
                                <th rowspan="1" colspan="1">Статус</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
            {{ $users->links() }}
        </div>
    </section>
    
@endsection

  
