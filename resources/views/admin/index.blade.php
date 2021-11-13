@extends('layouts.admin')

@section('title',"Главная")

@section('content')
    <!-- Main content -->
    <section class="content admin_content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-sm-6 col-12">
              <a href="{{route("admin.index")}}">
                <div class="small-box bg-info">
                <div class="inner p-2">
                  <h3>Главная</h3>
                </div>
                <div class="icon">
                  <i class="fas fa-home"></i>
                </div>
                <div class="small-box-footer">
                  More info <i class="fas fa-arrow-circle-right"></i>
                </div>
              </div>
              </a>
              <!-- small box -->
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
              <a href="{{route("anime.admin")}}">
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>Аниме</h3>
                  </div>
                  <div class="icon">
                    <i class="fas fa-sitemap"></i>
                  </div>
                  <div class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
              <a href="{{route("news.admin")}}">
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>Новости</h3>
                  </div>
                  <div class="icon">
                    <i class="far fa-newspaper"></i>
                  </div>
                  <div class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
              <a href="{{route("team.admin")}}">
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h3>Команда</h3>
                  </div>
                  <div class="icon">
                    <i class="fas fa-user-friends"></i>
                  </div>
                  <div class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
              <a href="{{route("categories.index")}}">
                <div class="small-box bg-dark">
                  <div class="inner">
                    <h3>Жанры</h3>
                  </div>
                  <div class="icon">
                    <i class="fas fa-th"></i>
                  </div>
                  <div class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
              <a href="{{route("studios.index")}}">
                <div class="small-box bg-light">
                  <div class="inner">
                    <h3>Студии</h3>
                  </div>
                  <div class="icon">
                    <i class="fas fa-pencil-ruler"></i>
                  </div>
                  <div class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-sm-6 col-12">
              <a href="{{route("users.index")}}">
                <div class="small-box bg-secondary">
                  <div class="inner">
                    <h3>Пользователи</h3>
                  </div>
                  <div class="icon">
                    <i class="fas fa-users"></i>
                  </div>
                  <div class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                  </div>
                </div>
              </a>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
          <!-- Main row -->
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
    <!-- /.control-sidebar -->
@endsection

  
