@extends('layouts.admin')

@section('title',"Аниме")

@section('content')
    <section class="content admin_content pb-3">
        <div class="container-fluid">
            <div class="card card-primary">
                <form method="POST" action = "{{ route("releases.update", ['release'=> $relize]) }}" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="card-body" style="background: rgb(24, 24, 24);">

                        <div class="card mb-3" style="background: inherit;">
                            <div class="col-12 row g-0 p-0">
                              <div class="col-lg-3 col-md-4 col-sm-5 mb-sm-0 mb-2">
                                <div class="file-upload">
                                    <img src="{{ asset("/images/animes/".$relize->image) }}" class="file-upload__img" alt="">
                                    <input type="file" name = "image" class="file-upload__input" multiple>
                                </div>
                                @error('image') <p class="error text-danger mt-2">{{ $message }}</p> @enderror
                              </div>
                              <div class="col-lg-9 col-md-8 col-sm-7">
                                <div class="card-body p-0">
                                    <div class="form-group">
                                        <label for="input_title">Название релиза</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name = "title" id="input_title" 
                                        value="{{ $relize->title }}" placeholder="Название релиза">
                                        @error('title') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
            
                                    <div class="form-group">
                                        <label for="original_title">Оригинальное название</label>
                                        <input type="text" class="form-control @error('original_title') is-invalid @enderror" id = "original_title" value="{{ $relize->original_title }}" name = "original_title" 
                                        placeholder="Оригинальное название">
                                        @error('original_title') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="categories">Жанр</label>
                                        <div @error('categories') class="is-invalid" @enderror>
                                            <select class="mult_select" data-placeholder="Жанры" multiple="" 
                                            name="categories[]" id="categories">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" 
                                                        @if($relize->categories && in_array($category->id, $relize->categories->pluck('id')->toArray() )) selected @endif>
                                                        {{ $category->name }}	
                                                    </option> 
                                                @endforeach	 	
                                            </select>
                                        </div>
                                        @error('categories') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
            
                                    <div class="form-group">
                                        <label for="voices">Дабберы</label>
                                        <div @error('voices') class="is-invalid" @enderror>
                                            <select class="mult_select" data-placeholder="Дабберы" multiple="" name="voices[]" id="voices">
                                                @foreach ($voices as $voice)
                                                    <option value="{{ $voice->id }}" 
                                                        @if($relize->voices && in_array($voice->id, $relize->voices->pluck('id')->toArray() )) selected @endif>
                                                        {{ $voice->name }}	
                                                    </option> 
                                                @endforeach	 	
                                            </select>
                                        </div>
                                        @error('voices') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        <div class="form-group">
                            <label for="studio">Студия</label>
                            <select class="custom-select @error('studio_id') is-invalid @enderror" id="studio" name = "studio_id">
                                <option selected disabled>Студия</option>
                                @foreach ($studios as $studio)
                                    <option value="{{ $studio->id }}"
                                        @if ($relize->studio_id == $studio->id)  selected   @endif>
                                        {{ $studio->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('studio_id') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="type_input">Тип</label>
                            <input type="text" class="form-control @error('type') is-invalid @enderror" id = "type_input" 
                            name = "type" value="{{ $relize->type }}" placeholder="Тип">
                            @error('type') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="year">Год</label>
                            <select class="custom-select @error('year') is-invalid @enderror" id="year" name = "year">
                                <option selected disabled>Год</option>
                                <?php
                                for($i = date("Y"); $i > 2000; $i--) { ?>
                                    <option value="{{ $i }}" @if($relize->year == $i) selected @endif>
                                        {{ $i }}
                                    </option>
                                <?php } ?>
                            </select>
                            @error('year') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="producer_input">Режиссёр</label>
                            <input type="text" class="form-control @error('producer') is-invalid @enderror" id = "producer_input" name = "producer" 
                            value="{{ $relize->producer }}" placeholder="Режиссёр">
                            @error('producer') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="timing_input">Тайминг</label>
                            <input type="text" class="form-control @error('timing') is-invalid @enderror" id = "timing_input" name = "timing" 
                            value="{{ $relize->timing }}" placeholder="Тайминг">
                            @error('timing') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="contry_input">Страна</label>
                            <input type="text" class="form-control @error('contry') is-invalid @enderror" id = "contry_input" name = "contry" 
                            value="{{ $relize->contry }}" placeholder="Страна">
                            @error('contry') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="transfer_input">Перевод</label>
                            <input type="text" class="form-control @error('transfer') is-invalid @enderror" id = "transfer_input" 
                            name = "transfer" value="{{ $relize->transfer }}" placeholder="Перевод">
                            @error('transfer') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="planned_input">Запланирывано серий</label>
                            <input type="number" class="form-control @error('planned_series') is-invalid @enderror" id = "planned_input" 
                            name = "planned_series" value="{{ $relize->planned_series }}" placeholder="Запланирывано серий">
                            @error('planned_series') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="description_input">Описание</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id = "description_input" name = "description"
                            placeholder="Описание">{{ $relize->description }}</textarea>
                            @error('description') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="poster_input">Плакат (необязательно)</label>
                            <div class="file-upload" style="padding-top: 40%;">
                                <img src="{{ asset($relize->poster ? "/images/animes/".$relize->poster : "/images/assets/5x5.png") }}" class="file-upload__img" alt="">
                                <input type="file" name = "poster" id="poster_input" class="file-upload__input" multiple>
                            </div>
                            @error('poster') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group">
                            <label for="logo_input">Логотип (необязательно)</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name = "logo" class="custom-file-input" id="logo_input" multiple>
                                <label class="custom-file-label" for="logo_input">
                                    @if ($relize->logo)
                                        {{ $relize->logo }}
                                    @else
                                        Выберите файл
                                    @endif
                                </label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="trailer_input">Трейлер (необязательно)</label>
                            <textarea class="form-control" id = "trailer_input" name = "trailer"  
                            placeholder="Трейлер">{{ $relize->trailer }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-switch custom-switch-on-danger">
                              <input type="checkbox" class="custom-control-input" id="license_input" name="license" 
                              @if($relize->license) checked @endif>
                              <label class="custom-control-label" for="license_input">Лицензировано</label>
                            </div>
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

<?php /*

    <script>
        const fileInput = document.querySelector("#file_input");
        fileInput.addEventListener("change",(event) => {
            fileInput.nextElementSibling.innerHTML = event.target.files[0].name;
        })
    </script>
*/?>

  
