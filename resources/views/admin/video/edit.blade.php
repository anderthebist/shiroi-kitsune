@extends('layouts.admin')

@section('title',"Видео")

@section('content')
    <section class="content admin_content pb-3">
        <div class="container-fluid">
            <form method="POST" class="mb-3" action = "{{ route("videos.update", ["video"=> $video]) }}" enctype="multipart/form-data">
                @csrf
                @method("PUT")

                <div class="card-body" style="background: rgb(24, 24, 24);">
                    <p>
                        Релиз: 
                        <span class="text-danger">
                            {{ $video->anime->title }}
                        </span>
                    </p>

                    <div class="form-group">
                        <label for="input_number">Номер серии</label>
                        <input type="number" class="form-control @error('number_video') is-invalid @enderror" name = "number_video" id="input_number" 
                        value="{{ $video->number_video }}" placeholder="Номер серии">
                        @error('number_video') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="content_input">Ссылка</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id = "content_input" name = "content"  
                        placeholder="Ссылка">{{ $video->content }}</textarea>
                        @error('content') <span class="error invalid-feedback">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="card-footer" style="background: #1e1e1e">
                    <button type="submit" class="btn btn-danger">Обновить</button>
                </div>
            </form>
        </div>
    </section>
    
@endsection

  
