@extends('layouts.admin')

@section('title',"Команда")

@section('scripts')
  <script src="https://cdn.tiny.cloud/1/2bfv3kj9xkhl1uhx73clkjxo2chwtgbj1haawkmxfdppyfuf/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

  <script>
    tinymce.init({
        selector: '#text_description',
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
                <form method="POST" action = "{{ route("team.store") }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body" style="background: rgb(24, 24, 24);">

                        <div class="card mb-3" style="background: inherit;">
                            <div class="col-12 row g-0 p-0">
                              <div class="col-lg-3 col-md-4 col-sm-5 mb-sm-0 mb-2">
                                <div class="file-upload" style="padding-top: 120%;">
                                    <img src="{{ asset("/images/users/default-user-image.png") }}" class="file-upload__img" alt="">
                                    <input type="file" name = "image" class="file-upload__input" multiple>
                                </div>
                                @error('image') <p class="error text-danger mt-2">{{ $message }}</p> @enderror
                              </div>
                              <div class="col-lg-9 col-md-8 col-sm-7">
                                <div class="card-body p-0">
                                    <div class="form-group">
                                        <label for="input_name">Имя</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name = "name" id="input_name" 
                                        value="{{old("name")}}" placeholder="Имя">
                                        @error('name') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
            
                                    <div class="form-group">
                                        <label for="input_status">Роль в команде (необязательно)</label>
                                        <input type="text" class="form-control @error('status') is-invalid @enderror" name = "status" id="input_status" 
                                        value="{{old("status")}}" placeholder="Роль в команде">
                                        @error('status') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>

                        <div class="form-group">
                          <label for="text_description">Описание (необязательно)</label>
                          <textarea class="form-control @error('description') is-invalid @enderror" id = "text_description" name = "description"
                          placeholder="Описание">{{ old("description") }}</textarea>
                          @error('description') <span class="error invalid-feedback">{{ $message }}</span> @enderror
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

  
