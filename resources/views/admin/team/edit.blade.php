@extends('layouts.admin')

@section('title',"Команда")

@section('content')
    <section class="content admin_content pb-3">
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="POST" action = "{{ route("team.update", ['team'=> $voice]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card-body" style="background: rgb(24, 24, 24);">
                        <div class="form-group">
                            <label for="input_name">Имя</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name = "name" id="input_name" 
                            value="{{ $voice->name }}" placeholder="Имя">
                            @error('name') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="image_input">Картинка</label>
                            <div class="input-group @error('image') is-invalid @enderror">
                                <div class="custom-file">
                                    <input type="file" name = "image" class="custom-file-input" id="image_input" multiple>
                                    <label class="custom-file-label" for="image_input">{{ $voice->image }}</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                            @error('image') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_status">Роль в команде (необязательно)</label>
                            <input type="text" class="form-control @error('status') is-invalid @enderror" name = "status" id="input_status" 
                            value="{{ $voice->status }}" placeholder="Роль в команде">
                            @error('status') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="text_description">Описание (необязательно)</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id = "description_input" name = "description"
                            placeholder="Описание">{{ $voice->description }}</textarea>
                            @error('description') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer" style="background: #1e1e1e">
                    <button type="submit" class="btn btn-danger">Обновить</button>
                  </div>
                </form>
              </div>
        </div>
    </section>
    
@endsection

  
