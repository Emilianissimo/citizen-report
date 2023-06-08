@extends('admin.layout')

@section('title', 'Изменение услуги')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Изменение на сайте</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
          <li class="breadcrumb-item"><a href="{{route('service-categories.show', $category->id)}}">{{$category->title_ru}}</a></li>
          <li class="breadcrumb-item active">Услуги</li>
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
          <h3 class="card-title">Изменение услуги</h3>
          <div class="text-right">
            <a style="font-size: 25px" href="{{route('services.show', ['category_id'=>$category->id, 'service'=>$service->id])}}" class="fa fa-eye" title="Вопросы и ответы"></a>
          </div>
        </div>
        {{Form::open([
          'route' => ['services.update', ['category_id' => $category->id, 'service' => $service->id]],
          'method'=>'put'
          ])}}
          @include('admin.errors')
          <div class="box-body">
            <div class="row" style="padding: 20px;">
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="title_ru">Название Ру <span style="color:red">*</span></label>
                    <input type="text" class="form-control" id="title_ru" placeholder="" value="{{$service->title_ru}}" name="title_ru">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">Название Уз</label>
                    <input type="text" class="form-control" id="title_uz" placeholder="" value="{{$service->title_ru}}" name="title_uz">
                  </div>
                  <div class="form-group">
                    <label>Родительская категория</label>
                    <select name="category_id" class="form-control select2 select2-warning">
                      <option value="">---</option>
                      @foreach($categories as $cat)
                        <option @if($cat->id == $category->id) selected @endif value="{{$cat->id}}">{{$cat->title_ru}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <img src="{{$service->getIcon()}}" style="width: 200px" alt="">
                    <label for="icon">Иконка <span class="text-danger">*</span></label>
                    <input type="file" name="icon" class="form-control">
                  </div>
              </div>
              <div class="col-md-6">
                  <div class="form-group">
                    <label for="title_uz">SEO заголовок RU <span id="seo_title_ru_counter"></span>/60</label>
                    <input type="text" class="form-control" id="seo_title_ru" placeholder="Если пустой, будет взят и обрезан из актуального названия" value="{{$service->seo_title_ru}}" name="seo_title_ru">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO заголовок UZ  <span id="seo_desc_uz_counter"></span>/60</label>
                    <input type="text" class="form-control" id="seo_title_uz" placeholder="Если пустой, будет взят и обрезан из актуального названия" value="{{$service->seo_title_uz}}" name="seo_title_uz">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO ключи RU</label>
                    <input type="text" class="form-control" required id="seo_keys_ru" placeholder="Через запятую, прим.: Ташкент, Хирургия, Врачи в ташкенте" value="{{$service->seo_keys_ru}}" name="seo_keys_ru">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO ключи UZ</label>
                    <input type="text" class="form-control" required id="seo_keys_uz" placeholder="Через запятую, прим.: Ташкент, Хирургия, Врачи в ташкенте" value="{{$service->seo_keys_uz}}" name="seo_keys_uz">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO описание RU  <span id="seo_desc_ru_counter"></span>/165</label>
                    <input type="text" class="form-control" id="seo_desc_ru" value="{{$service->seo_desc_ru}}" name="seo_desc_ru">
                  </div>
                  <div class="form-group">
                    <label for="title_uz">SEO описание UZ  <span id="seo_desc_uz_counter"></span>/165</label>
                    <input type="text" class="form-control" id="seo_desc_uz" value="{{$service->seo_desc_uz}}" name="seo_desc_uz">
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="form-group">
                    <label for="description_ru">Описание РУ</label>
                    <textarea name="description_ru" class="form-control" required>{{$service->description_ru}}</textarea>
                  </div>
              </div>

              <div class="col-md-6">
                  <div class="form-group">
                    <label for="description_uz">Описание Уз</label>
                    <textarea name="description_uz" class="form-control" required>{{$service->description_uz}}</textarea>
                  </div>
              </div>
             
              <div class="col-md-12">
                  <div class="box-footer">
                      <a href="{{route('service-categories.show', $category->id)}}" class="btn btn-default">Назад</a>
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