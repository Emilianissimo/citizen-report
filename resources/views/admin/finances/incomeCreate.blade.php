@extends('admin.layout')

@section('title', 'Создание прихода')

@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Создать приход</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Главная</a></li>
          <li class="breadcrumb-item"><a href="{{route('finances.index')}}">приход</a></li>
          <li class="breadcrumb-item active">Создать</li>
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
          <h3 class="card-title">Добавление прихода</h3>
        </div>
        {{Form::open([
          'route' => 'finances.incomeStore',
          'method'=>'post',
          'files' => 'true'
          ])}}
          <div class="box-body">
            <div class="row" style="padding: 20px;">

              <div class="col-md-6">
                <div class="form-group">
                  <label for="from">От кого<span style="color:red">*</span></label>
                  <input type="text" required class="form-control" id="from" placeholder="" value="" name="from">
                </div>
              </div>
            
              <div class="col-md-6">
                <div class="form-group">
                  <label for="text">Текст<span style="color:red">*</span></label>
                  <textarea name="text" required cols="30" rows="10" class="form-control"></textarea>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="amount">Сумма<span style="color:red">*</span></label>
                  <input type="number" class="form-control" id="amount" placeholder="" value="" name="amount">
                </div>
              </div>
 
              <div class="col-md-12">
                <div class="form-group" style="border: 1px solid red; padding: 10px">
                  <label for="image" style="width: 100%;object-fit: cover;object-position: center center;">Картинка</label>
                  <input type="file" id="image" name="image">

                  <p class="help-block">Картинка в формате JPG</p>
                </div>              
              </div>

                <div class="col-md-12 mt-5">
                    <div class="box-footer">
                        <a href="{{route('finances.index')}}" class="btn btn-default">Назад</a>
                        <button class="btn btn-warning float-right">Изменить</button>
                    </div>
                </div> 
            </div>
        </div>
      {{Form::close()}}
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
