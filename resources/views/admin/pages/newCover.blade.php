@extends('admin/layout/adminLayout')
@section('content')
  @if (session('error'))
      <div class='alert alert-danger'>نوع الملف يجب ان يكون صوره</div>
  @endif
    <section class="content-header">
            <h1>
             إضافة غلاف
            <small> </small>
            </h1>
    </section>
    <section class="content">
            <div class="box box-primary">
                    <div class="box-header with-border">
                      <h2 class="box-title">غلاف جديد  </h2>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form action="new/add" method="POST" enctype="multipart/form-data">
                        @csrf
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputEmail1">  نوع الغلاف</label>
                          <select class="form-control" name="type">
                              <option value="moveable">moveable</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputFile"> الغلاف  </label>
                          <input type="file"  name="cover">
                        </div>
                      </div><!-- /.box-body -->
    
                      <div class="box-footer">
                        <button type="submit" id="submit" class="btn btn-primary">إضافة</button>
                      </div>
                    </form>
                  </div>
    </section>        
    @section('script')
        <script>

        </script>
    @endsection
@endsection