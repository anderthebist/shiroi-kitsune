@extends('layouts.admin')

@section('title',"Видео")

@section('content')
    <section class="content admin_content pb-3">
        <div class="container-fluid">
            <form method="POST" class="mb-3" action = "{{ route("videos.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body" style="background: rgb(24, 24, 24);">
                    <div class="form-group">
                        <label for="relize">Релиз</label>
                        <select class="custom-select @error('anime_id') is-invalid @enderror" id="relize" name = "anime_id">
                            <option selected disabled>Релиз</option>
                            @foreach ($relizes as $relize)
                                <option value="{{ $relize->id }}"
                                    @if (old("relize_id") == $relize->id)  selected   @endif>
                                    {{ $relize->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('anime_id') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="input_number">Номер серии</label>
                        <input type="number" class="form-control @error('number_video') is-invalid @enderror" name = "number_video" id="input_number" 
                        value="{{old("number_video")}}" placeholder="Номер серии">
                        @error('number_video') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="content_input">Ссылка</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id = "content_input" name = "content"  
                        placeholder="Ссылка">{{ old("content") }}</textarea>
                        @error('content') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="card-footer" style="background: #1e1e1e">
                    <button type="submit" class="btn btn-danger">Создать</button>
                </div>
            </form>
        </div>
    </section>
    
@endsection

  
