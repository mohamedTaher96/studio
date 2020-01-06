@extends('admin/layout/adminLayout')
@section('content')
    @if (session('error'))
    <div class='alert alert-danger'>  الملف مطلوب</div>
    @endif
    <section class="content-header">
            <h1>
             تعديل بروفيل الشركة
            <small> </small>
            </h1>
    </section>
    <section class="content">
            <div class="box box-primary">
                    <div class="box-header with-border">
                    
                    </div><!-- /.box-header -->
                    <!-- form start -->
                <form action="profile/update" method="POST" enctype="multipart/form-data" >
                        @csrf
                      <div class="box-body">
                        <div class="form-group">
                          <label for="exampleInputFile"> بروفيل الشركة  </label>
                            <input type="file"  name="profile">
                        </div>
                      </div><!-- /.box-body -->
    
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