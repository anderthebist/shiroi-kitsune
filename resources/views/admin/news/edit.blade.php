@extends('layouts.admin')

@section('title',"Новости")

@section('content')
    <section class="content admin_content pb-3">
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="POST" action = "{{ route("news.update", $news) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div class="card-body" style="background: rgb(24, 24, 24);">
                        <div class="form-group">
                            <label for="input_title">Название новости</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name = "title" id="input_title" value="{{ $news->title }}" placeholder="Название релиза">
                            @error('title') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="image_input">Картинка</label>
                            <div class="input-group @error('image') is-invalid @enderror">
                                <div class="custom-file">
                                    <input type="file" name = "image" class="custom-file-input" id="image_input" multiple>
                                    <label class="custom-file-label" for="image_input">{{ $news->image }}</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                            @error('image') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="video_input">Видео (необязательно)</label>
                            <textarea class="form-control" id = "video_input" name = "video"  
                            placeholder="Видео">{{ $news->video }}</textarea>
                            @error('video') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_author">Автор</label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror" name = "author" id="input_author" 
                            value="{{ $news->author }}" placeholder="Автор">
                            @error('author') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="text_input">Текст</label>
                            <textarea class="form-control @error('text') is-invalid @enderror" id = "text_input" name = "text"
                            placeholder="Текст">{{ $news->text }}</textarea>
                            @error('text') <span class="error invalid-feedback">{{ $message }}</span> @enderror
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
  
