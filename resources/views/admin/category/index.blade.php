@extends('layouts.admin')

@section('title',"Категории")

@section('styles')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
    <section class="content admin_content pb-3">
        <div class="container-fluid">
            <form method="POST" class="mb-3" action = "{{ route("categories.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body" style="background: rgb(24, 24, 24);">
                    <div class="form-group">
                        <label for="input_name">Название</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name = "name" id="input_name" 
                        value="{{old("name")}}" placeholder="Название">
                        @error('name') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
              <!-- /.card-body -->

                <div class="card-footer" style="background: #1e1e1e">
                    <button type="submit" class="btn btn-danger">Создать</button>
                </div>
            </form>

            <div class="row">
                <div class="col-sm-12">
                    <table id="example1" class="table table-bordered table-striped dataTable dtr-inline" role="grid" aria-describedby="example1_info">
                        <thead>
                            <tr>
                                <th rowspan="1" colspan="1">ID</th>
                                <th rowspan="1" colspan="1">Имя</th>
                                <th rowspan="1" colspan="1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="odd">
                                    <td>{{$category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ route("categories.edit",$category) }}">
                                            <button class="btn btn-success" style="margin-bottom: 5px">
                                                Редактировать
                                            </button>
                                        </a>
                                        <form action={{route("categories.destroy",$category)}} method="POST">
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
                                <th rowspan="1" colspan="1"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            
            {{ $categories->links() }}
        </div>
    </section>
    
@endsection

  
