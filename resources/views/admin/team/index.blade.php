@extends('layouts.admin')

@section('title',"Команда")

@section('styles')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
    <section class="content admin_content pb-3">
        <div class="container-fluid">
            <div class="row">
                <div class="table-container col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Имя</th>
                                <th rowspan="1" colspan="1">Картинка</th>
                                <th rowspan="1" colspan="1">Роль в команде</th>
                                <th rowspan="1" colspan="1">Описание</th>
                                <th rowspan="1" colspan="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($voicers as $voicer)
                                <tr class="odd">
                                    <td>{{ $voicer->id }}</td>
                                    <td>{{ $voicer->name }}</td>
                                    <td>
                                        <img src="{{ $voicer->image ? asset("/images/voicers/".$voicer->image) 
                                        : asset("/images/users/default-user-image.png") }}" style="max-width: 100px" alt="">
                                    </td>
                                    <td>
                                        {{ $voicer->status }}
                                    </td>
                                    <td>
                                        <div style="overflow: hidden;
                                        text-overflow: ellipsis;
                                        display: -webkit-box;
                                        -webkit-line-clamp: 3; 
                                        -webkit-box-orient: vertical;">
                                            {{ strip_tags($voicer->description) }}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route("team.edit",$voicer) }}">
                                            <button class="btn btn-success" style="margin-bottom: 5px">
                                                Редактировать
                                            </button>
                                        </a>
                                        <form action={{route("team.destroy",$voicer)}} method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="delete_btn btn btn-danger">
                                                Удалить
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Имя</th>
                                <th rowspan="1" colspan="1">Картинка</th>
                                <th rowspan="1" colspan="1">Роль в команде</th>
                                <th rowspan="1" colspan="1">Описание</th>
                                <th rowspan="1" colspan="1"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
            {{ $voicers->links() }}
        </div>
    </section>
    
@endsection

  
