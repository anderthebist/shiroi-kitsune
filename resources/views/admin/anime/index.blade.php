@extends('layouts.admin')

@section('title',"Аниме")

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
                                <th rowspan="1" colspan="1">Картинка</th>
                                <th rowspan="1" colspan="1">Название</th>
                                <th rowspan="1" colspan="1">Оригинальное название</th>
                                <th rowspan="1" colspan="1">Оценка</th>
                                <th rowspan="1" colspan="1">Год</th>
                                <th rowspan="1" colspan="1">Лицензирывано</th>
                                <th rowspan="1" colspan="1"></th>
                            </tr>
                        </thead>
                        <tbody id="anime_result">
                            @foreach ($relizes as $relize)
                                <tr class="odd">
                                    <td>{{ $relize->id }}</td>
                                    <td>
                                        <a href="{{ route("releases.show", ["release"=> $relize->original_title]) }}">
                                            <img src="{{asset("/images/animes/".$relize->image)}}" style="max-width: 75px" alt="">
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route("releases.show", ["release"=> $relize->original_title]) }}">
                                            {{ $relize->title }}
                                        </a>
                                    </td>
                                    <td>{{ str_replace('_', ' ', $relize->original_title) }}</td>
                                    <td>{{ $relize->mark }}</td>
                                    <td>{{ $relize->year }}</td>
                                    <td>{{ $relize->license ? "Да" : "Нет" }}</td>
                                    <td>
                                        <a href="{{ route("anime.edit", ['id' => $relize->id]) }}">
                                            <button class="btn btn-success" style="margin-bottom: 5px">
                                                Редактировать
                                            </button>
                                        </a>
                                        <form action={{route("releases.destroy",$relize)}} method="POST">
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
                                <th rowspan="1" colspan="1">Картинка</th>
                                <th rowspan="1" colspan="1">Название</th>
                                <th rowspan="1" colspan="1">Оригинальное название</th>
                                <th rowspan="1" colspan="1">Оценка</th>
                                <th rowspan="1" colspan="1">Год</th>
                                <th rowspan="1" colspan="1">Лицензирывано</th>
                                <th rowspan="1" colspan="1"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
            {{ $relizes->links() }}
        </div>
    </section>
    
@endsection

  
