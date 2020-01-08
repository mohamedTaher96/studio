@extends('admin/layout/adminLayout')
@section('style')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('css/admin/dataTables.bootstrap.css')}}">
    <style>
        td
        {
            word-break: break-word;
        }
        .form-control
        {
            padding: 0px 12px;
        }
        img
        {
            width: 50px;
            height: 50px;
        }
    </style>
@endsection
@section('content')
@if (session('edit'))
    <div class='alert alert-success'><strong></strong>  تم تعديل الترجمه بنجاح. </div>
@endif

<section class="content-header">
        <h1>
        تعديل الترجمة
        <small> </small>
        </h1>
        <br>
</section>
<section class="">
        <div class="box">
                <div class="box-header">
                  <h3 class="box-title">  اللغات  </h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>  العربي</th>
                        <th> الإنجليزي</th>
                        <th> تعديل</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($translations as $translation)
                            <tr>
                                <td style="color:blue">{{$translation->ar}}</td>
                                <td style="color:blue">{{$translation->en}}</td>
                                <td><a role="button" class="btn btn-primary" href="translation/edit?id={{$translation->id}}">تعديل</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>  العربي</th>
                            <th> الإنجليزي</th>
                            <th> تعديل</th>
                        </tr>
                    </tfoot>
                  </table>
                </div>
        </div>
</section>

@endsection
@section('script')
        <!-- DataTables -->
        <script src="{{asset('js/admin/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('js/admin/dataTables.bootstrap.min.js')}}"></script>
        <script>
            $("#example1").DataTable();
            if($(".alert"))
            {
                window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                        });
                    }, 1000);
            }
        </script>
@endsection