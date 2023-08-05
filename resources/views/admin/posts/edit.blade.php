@extends('admin.layout')

@section('title', 'Изменение поста')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Статьи на сайте</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
          @if(Auth::user()->is_admin == 1)
          <li class="breadcrumb-item active"><a href="{{route('posts.index')}}">Организации</a></li>
          <li class="breadcrumb-item active"><a href="{{route('posts.postsForAdmin,$post->id')}}">Посты</a></li>
          <li class="breadcrumb-item active">Изменить</li>
          @elseif(Auth::user()->is_org_admin ==1)
          <li class="breadcrumb-item active"><a href="{{route('posts.index')}}">Посты</a></li>
          <li class="breadcrumb-item active">Изменить</li>
          @endif
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  @include('admin.errors')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Изменение статьи на сайте</h3>
        </div>
        {{Form::open([
          'route' => ['posts.update', $post->id],
          'files' => 'true',
          'method'=>'put'
          ])}}
          @include('admin.errors')
          <div class="box-body">
            <div class="row" style="padding: 20px;">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="title">Название<span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="title" placeholder="" value="{{$post->title}}" name="title">
                  </div>
              </div>

              <!-- checkbox -->
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="text">Описание Ру <span style="color:red">*</span></label>
                <textarea name="text" required cols="30" rows="10" class="form-control">{{$post->text}}</textarea>
              </div>
            </div>

            <div class="col-md-12">
              <div class="form-group" style="border: 1px solid red; padding: 10px">
                <label for="image" style="width: 100%;object-fit: cover;object-position: center center;">Картинка превью <br> <div style="background-image: url('{{$post->firstPic()}}')" class="video-image"></div></label>
                <input type="file" id="image" name="image">

                <p class="help-block">Картинка в формате JPG, PNG</p>
              </div>              
          </div>

            <div class="col-md-12 row" style="position: relative;">
                @foreach($post->gallery as $gallery)
                  <div  class="col-md-4 mt-2">
                    <img class="w-100" style="height:17rem;object-fit: cover;object-position: center center;" src="{{$gallery->getFile()}}" alt="">
                    <div class="trash-icon" style="position: absolute;top: 5px;right: 10px;">
                      <a href="{{route('posts.gallery.delete', $gallery->id)}}"><i style="font-size: 25px;color:red;" class="fa fa-trash"></i></a>
                    </div>
                  </div>
                @endforeach
            </div>

            <!-- checkbox -->
              <div class="col-md-12 mt-5">
                  <div class="box-footer">
                      <a href="{{route('posts.index')}}" class="btn btn-default">Назад</a>
                      <button class="btn btn-warning float-right">Изменить</button>
                  </div>
              </div>
          </div>
        {{Form::close()}}
      </div>
    </div>
  </div>
</section>
@endsection

@section('modal_script')
<script>
  $('#seo_title_ru').on('input', function() {
    let len = $(this).val().length;
    $('#seo_title_ru_counter').html(
      len
    )
    if(len > 60) {
      $('#seo_title_ru_counter').css('color', 'red')
    }else{
      $('#seo_title_ru_counter').css('color', 'black')
    }
  })

  $('#seo_title_uz').on('input', function() {
    let len = $(this).val().length;
    $('#seo_title_uz_counter').html(
      len
    )
    if(len > 60) {
      $('#seo_title_uz_counter').css('color', 'red')
    }else{
      $('#seo_title_uz_counter').css('color', 'black')
    }
  })

  $('#seo_desc_ru').on('input', function() {
    let len = $(this).val().length;
    $('#seo_desc_ru_counter').html(
      len
    )
    if(len > 165) {
      $('#seo_desc_ru_counter').css('color', 'red')
    }else{
      $('#seo_desc_ru_counter').css('color', 'black')
    }
  })

  $('#seo_desc_uz').on('input', function() {
    let len = $(this).val().length;
    $('#seo_desc_uz_counter').html(
      len
    )
    if(len > 165) {
      $('#seo_desc_uz_counter').css('color', 'red')
    }else{
      $('#seo_desc_uz_counter').css('color', 'black')
    }
  })
</script>

<style>
  .trash-icon:hover{
    scale: 2;
  }
</style>
@endsection
