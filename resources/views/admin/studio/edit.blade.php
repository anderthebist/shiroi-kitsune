@extends('layouts.admin')

@section('title',"Категории")

@section('styles')
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
    <section class="content admin_content pb-3">
        <div class="container-fluid">
            <form method="POST" class="mb-3" action = "{{ route("studios.update", ["studio"=> $studio]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="card-body" style="background: rgb(24, 24, 24);">
                    <div class="form-group">
                        <label for="input_name">Название</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name = "name" id="input_name" 
                        value="{{ $studio->name }}" placeholder="Название">
                        @error('name') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>
              <!-- /.card-body -->

                <div class="card-footer" style="background: #1e1e1e">
                    <button type="submit" class="btn btn-danger">Обновить</button>
                </div>
            </form>
        </div>
    </section>
    
@endsection

  
