@extends('layouts.admin')

@section('title',"Новости")

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
                                <th rowspan="1" colspan="1">Название</th>
                                <th rowspan="1" colspan="1">Картинка</th>
                                <th rowspan="1" colspan="1">Текст</th>
                                <th rowspan="1" colspan="1">Автор</th>
                                <th rowspan="1" colspan="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($news as $new)
                                <tr class="odd">
                                    <td>{{ $new->id }}</td>
                                    <td>{{ $new->title }}</td>
                                    <td>
                                        <img src="{{asset("/images/news/".$new->image)}}" style="max-width: 150px" alt="">
                                    </td>
                                    <td>
                                        <div style="overflow: hidden;
                                        text-overflow: ellipsis;
                                        display: -webkit-box;
                                        -webkit-line-clamp: 3; 
                                        -webkit-box-orient: vertical;">
                                            {{ strip_tags($new->text) }}
                                        </div>
                                        
                                    </td>
                                    <td>
                                        {{ $new->author }}
                                    </td>
                                    <td>
                                        <a href="{{ route("news.edit",$new) }}">
                                            <button class="btn btn-success" style="margin-bottom: 5px">
                                                Редактировать
                                            </button>
                                        </a>
                                        <form action={{route("news.destroy",$new)}} method="POST">
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
                                <th rowspan="1" colspan="1">Название</th>
                                <th rowspan="1" colspan="1">Картинка</th>
                                <th rowspan="1" colspan="1">Текст</th>
                                <th rowspan="1" colspan="1">Автор</th>
                                <th rowspan="1" colspan="1"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
            {{ $news->links() }}
        </div>
    </section>
    
@endsection

  
