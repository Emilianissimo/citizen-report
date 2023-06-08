@extends('admin.layout')

@section('title', 'Создание поста')

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
          <li class="breadcrumb-item active">Статьи</li>
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
          <h3 class="card-title">Добавление статьи на сайт</h3>
        </div>
        {{Form::open([
          'route' => 'posts.store',
          'files' => 'true'
          ])}}
          <div class="box-body">
            <div class="row" style="padding: 20px;">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="title_ru">Название Ру <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="title_ru" placeholder="" value="{{old('title_ru')}}" name="title_ru">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="title_en">Название Уз</label>
                    <input type="text" class="form-control" id="title_uz" placeholder="" value="{{old('title_uz')}}" name="title_uz">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="title_uz">SEO заголовок RU <span id="seo_title_ru_counter">0</span>/60</label>
                    <input type="text" class="form-control" id="seo_title_ru" placeholder="Если пустой, будет взят и обрезан из актуального названия" value="{{old('seo_title_ru')}}" name="seo_title_ru">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO заголовок UZ <span id="seo_title_uz_counter">0</span>/60</label>
                    <input type="text" class="form-control" id="seo_title_uz" placeholder="Если пустой, будет взят и обрезан из актуального названия" value="{{old('seo_title_uz')}}" name="seo_title_uz">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO ключи RU</label>
                    <input type="text" class="form-control" required id="seo_keys_ru" placeholder="Через запятую, прим.: Ташкент, Хирургия, Врачи в ташкенте" value="{{old('seo_keys_ru')}}" name="seo_keys_ru">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO ключи UZ</label>
                    <input type="text" class="form-control" required id="seo_keys_uz" placeholder="Через запятую, прим.: Ташкент, Хирургия, Врачи в ташкенте" value="{{old('seo_keys_uz')}}" name="seo_keys_uz">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO описание RU <span id="seo_desc_ru_counter">0</span>/165</label>
                    <input type="text" class="form-control" id="seo_desc_ru" placeholder="Если пустой, будет взят и обрезан из актуального описания" value="{{old('seo_desc_ru')}}" name="seo_desc_ru">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO описание UZ <span id="seo_desc_uz_counter">0</span>/165</label>
                    <input type="text" class="form-control" id="seo_desc_uz" placeholder="Если пустой, будет взят и обрезан из актуального описания" value="{{old('seo_desc_uz')}}" name="seo_desc_uz">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group" style="border: 1px solid red; padding: 10px">
                    <label for="image" style="width: 100%">Картинка превью <br> <div style="background-image: url('/img/no-image.png')" class="video-image"></div></label>
                    <input type="file" id="image" name="image">

                    <p class="help-block">Картинка в формате JPG, PNG</p>
                  </div>              
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label>Категории</label>
                    {{Form::select('categories[]',
                      $categories, null, ['class' => 'form-control select2 select2-danger', 'multiple' => 'multiple', 'data-placeholder'=>'Выберите Категории']
                    )}}
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label>Врач</label>
                    {{Form::select('doctor_id',
                      $doctors, null, ['class' => 'form-control select2 select2-danger']
                    )}}
                </div>
              </div>
              
              

              <!-- checkbox -->
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="description_ru">Описание Ру <span style="color:red">*</span></label>
                <textarea name="description_ru" required cols="30" rows="10" class="form-control">{{old('description_ru')}}</textarea>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                  <label for="description_uz">Описание Уз</label>
                  <textarea name="description_uz" cols="30" rows="10" class="form-control">{{old('description_uz')}}</textarea>
              </div>
            </div>
            <!-- checkbox -->
              <div class="col-md-6">
                <div class="form-group">
                  <label>
                    <input type="checkbox" class="minimal" id="publish" name="publish">
                  </label>
                  <label for="publish">
                    Опубликовано
                  </label>
                </div>  
              </div>
              <div class="col-md-12">
                  <div class="box-footer">
                      <a href="{{route('posts.index')}}" class="btn btn-default">Назад</a>
                      <button class="btn btn-success float-right">Добавить</button>
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
@endsection
