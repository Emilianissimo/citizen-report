@extends('admin.layout')

@section('title', 'Изменение категории')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Категории услуг на сайте</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
          <li class="breadcrumb-item active">Категории услуг</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Изменение категории услуг на сайте</h3>
          <div class="form-group" style="text-align: right">
            <a href="{{route('service-categories.show', $category->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
          </div>
        </div>
        {{Form::open([
          'route' => ['service-categories.update', $category->id],
          'method'=>'put',
          'files' => true
          ])}}
          @include('admin.errors')
          <div class="box-body">
            <div class="row" style="padding: 20px;">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="title_ru">Название Ру <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="title_ru" placeholder="" value="{{$category->title_ru}}" name="title_ru">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">Название Уз</label>
                    <input type="text" class="form-control" id="title_uz" placeholder="" value="{{$category->title_ru}}" name="title_uz">
                  </div>
                  <div class="form-group">
                    <label for="sup_title_ru">Тип Категории Ру <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="sup_title_ru" placeholder="" value="{{$category->sup_title_ru}}" name="sup_title_ru">
                  </div>
                  <div class="form-group">
                    <label for="sup_title_uz">Тип Категории Уз</label>
                    <input type="text" class="form-control" id="sup_title_uz" placeholder="" value="{{$category->sup_title_uz}}" name="sup_title_uz">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="title_uz">SEO заголовок RU <span id="seo_title_ru_counter"></span>/60</label>
                    <input type="text" class="form-control" id="seo_title_ru" placeholder="Если пустой, будет взят и обрезан из актуального названия" value="{{$category->seo_title_ru}}" name="seo_title_ru">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO заголовок UZ  <span id="seo_desc_uz_counter"></span>/60</label>
                    <input type="text" class="form-control" id="seo_title_uz" placeholder="Если пустой, будет взят и обрезан из актуального названия" value="{{$category->seo_title_uz}}" name="seo_title_uz">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO ключи RU</label>
                    <input type="text" class="form-control" required id="seo_keys_ru" placeholder="Через запятую, прим.: Ташкент, Хирургия, Врачи в ташкенте" value="{{$category->seo_keys_ru}}" name="seo_keys_ru">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO ключи UZ</label>
                    <input type="text" class="form-control" required id="seo_keys_uz" placeholder="Через запятую, прим.: Ташкент, Хирургия, Врачи в ташкенте" value="{{$category->seo_keys_uz}}" name="seo_keys_uz">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO описание RU  <span id="seo_desc_ru_counter"></span>/165</label>
                    <input type="text" class="form-control" id="seo_desc_ru" value="{{$category->seo_desc_ru}}" name="seo_desc_ru">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO описание UZ  <span id="seo_desc_uz_counter"></span>/165</label>
                    <input type="text" class="form-control" id="seo_desc_uz" value="{{$category->seo_desc_uz}}" name="seo_desc_uz">
                  </div>
              </div>
             
              <div class="col-md-12">
                  <div class="box-footer">
                      <a href="{{route('categories.index')}}" class="btn btn-default">Назад</a>
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
@endsection