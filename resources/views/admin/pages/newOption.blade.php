@extends('admin/layout/adminLayout')
@section('style')
    <style>
        .form-control
        {
            padding: 0px 12px;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
            <h1>
            إضافة خيار
            <small> </small>
            </h1>
    </section>
    <section class="content">
            <div class="box box-primary">
                    <div class="box-header with-border">
                      <h2 class="box-title">خيار جديد  </h2>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="new/add" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1"> اسم الخيار</label>
                            <input type="text" class="form-control" name="arOption" ><br>
                            <label for="exampleInputEmail1"> انص الإنجليزي</label>
                            <input type="text" class="form-control" name="enOption" ><br>
                            <label for="exampleInputEmail1"> النوع </label>
                            <select class="form-control" name="type">
                                <option value="قسم 1"> قسم 1</option>
                                <option value="قسم 2"> قسم 2</option>
                            </select>  
                            <input type="hidden" name="package_id" value="{{ app('request')->input('package_id') }}">                          
                        </div>
                      </div><!-- /.box-body -->
    
                      <div class="box-footer">
                        <button type="submit" id="submit" class="btn btn-primary">إضافه</button>
                      </div>
                    </form>
                  </div>
    </section>        
    @section('script')
        <script>
        </script>
    @endsection
@endsection