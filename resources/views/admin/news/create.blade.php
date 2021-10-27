@extends('layouts.admin')

@section('title',"Новости")

@section('content')
    <section class="content admin_content pb-3">
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="POST" action = "{{ route("news.store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body" style="background: rgb(24, 24, 24);">
                        <div class="form-group">
                            <label for="input_title">Название новости</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name = "title" id="input_title" value="{{old("title")}}" placeholder="Название релиза">
                            @error('title') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="image_input">Картинка</label>
                            <div class="input-group @error('image') is-invalid @enderror">
                                <div class="custom-file">
                                    <input type="file" name = "image" class="custom-file-input" id="image_input" multiple>
                                    <label class="custom-file-label" for="image_input">Выберите файл</label>
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
                            placeholder="Видео">{{ old("video") }}</textarea>
                            @error('video') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="input_author">Автор</label>
                            <input type="text" class="form-control @error('author') is-invalid @enderror" name = "author" id="input_author" 
                            value="{{old("author")}}" placeholder="Автор">
                            @error('author') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="text_input">Текст</label>
                            <textarea class="form-control @error('text') is-invalid @enderror" id = "text_input" name = "text"
                            placeholder="Текст">{{ old("text") }}</textarea>
                            @error('text') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                    </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer" style="background: #1e1e1e">
                    <button type="submit" class="btn btn-danger">Создать</button>
                  </div>
                </form>
              </div>
        </div>
    </section>
    
@endsection

<?php /*
<section class="content">
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="POST" action = "" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                  <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            {{$errors->all()[0]}}
                        </div>
                    @endif
                    <div class="form-group">
                      <label for="exampleInputEmail1">Название шапки</label>
                      <input type="text" class="form-control" required name = "title" id="exampleInputEmail1" 
                      placeholder="Название шапки" value = "">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputFile">Картинка</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" name = "image" class="custom-file-input" id="file_input" multiple>
                          <label class="custom-file-label" for="file_input">{{$header->image}}</label>
                        </div>
                        <div class="input-group-append">
                          <span class="input-group-text">Upload</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Отправить</button>
                  </div>
                </form>
              </div>
        </div>
    </section>

    <script>
        const fileInput = document.querySelector("#file_input");
        fileInput.addEventListener("change",(event) => {
            fileInput.nextElementSibling.innerHTML = event.target.files[0].name;
        })
    </script>
*/?>

  
