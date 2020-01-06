@extends('admin/layout/adminLayout')
@section('content')
    <section class="content-header">
            <h1>
            تعديل الترجمة
            <small> </small>
            </h1>
    </section>
    <section class="content">

            <div class="box box-primary">
                    <div class="box-header with-border">
                      <h2 class="box-title">الترجمه الحالية  </h2>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="update" method="POST" enctype="multipart/form-data">
                        @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">  العربي</label>
                            <input type="text" class="form-control" name="ar" value="{{$translation->ar}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">  الإنجليزي</label>
                            <input type="text" class="form-control" name="en" value=" {{$translation->en}}">
                        </div>

                    </div>
                        <input type="hidden" name="id" value="{{$translation->id}}">
    
                    <div class="box-footer">
                        <button type="submit" id="submit" class="btn btn-primary">تعديل</button>
                    </div>
                    </form>
                  </div>
    </section>        
    @section('script')
        <script>

        </script>
    @endsection
@endsection