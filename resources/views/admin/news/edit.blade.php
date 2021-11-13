@extends('layouts.admin')

@section('title',"Новости")

@section('scripts')
  <script src="https://cdn.tiny.cloud/1/2bfv3kj9xkhl1uhx73clkjxo2chwtgbj1haawkmxfdppyfuf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <script>
    tinymce.init({
        selector: '#text_input',
        plugins: 'autolink fullscreen link advlist lists emoticons',
        toolbar: 'undo redo | fontselect | bold italic underline strikethrough link casechange | forecolor backcolor | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist |  emoticons removeformat | fullscreen',
        //toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify | numlist bullist checklist  | numlist bullist outdent indent  | removeformat',
        menubar: false,
        a_plugin_option: true,
        a_configuration_option: 400
    });
  </script>
@endsection

@section('content')
    <section class="content admin_content pb-3">
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="POST" action = "{{ route("news.update", $news) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")

                    <div class="card-body" style="background: rgb(24, 24, 24);">

                        <div class="card mb-3" style="background: inherit;">
                            <div class="col-12 row g-0 p-0">
                              <div class="col-lg-3 col-md-4 col-sm-5 mb-sm-0 mb-2">
                                <div class="file-upload" style="padding-top: 75%;">
                                    <img src="{{ asset("/images/news/".$news->image) }}" class="file-upload__img" alt="">
                                    <input type="file" name = "image" class="file-upload__input" multiple>
                                </div>
                                @error('image') <p class="error text-danger mt-2">{{ $message }}</p> @enderror
                              </div>
                              <div class="col-lg-9 col-md-8 col-sm-7">
                                <div class="card-body p-0">
                                  <div class="form-group">
                                    <label for="input_title">Название новости</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                    name = "title" id="input_title" value="{{ $news->title }}" placeholder="Название релиза">
                                    @error('title') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                                  </div>
                                  <div class="form-group">
                                      <label for="input_author">Автор</label>
                                      <input type="text" class="form-control @error('author') is-invalid @enderror" name = "author" id="input_author" 
                                      value="{{ $news->author }}" placeholder="Автор">
                                      @error('author') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                                  </div>
  
                                </div>
                              </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="video_input">Видео (необязательно)</label>
                            <textarea class="form-control" id = "video_input" name = "video"  
                            placeholder="Видео">{{ $news->video }}</textarea>
                            @error('video') <span class="error invalid-feedback">{{ $message }}</span> @enderror
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
  
