@extends('admin/layout/adminLayout')
@section('style')
    <style>
        td
        {
            padding: 12px;
        }
    </style>
@endsection
@section('content')
    <section class="content-header">
        <h1>
        تعديل نص الصفحات
        <small> </small>
        </h1>
        <br>
    </section>
    <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">  الصفحات  </h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>اسم الصفحة</th>
                                <th> النص العربي</th>
                                <th> النص الانجليزي</th>
                            </tr>

                         </thead>
                        <tbody id="tbody">
                            {!!$html!!}
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
@endsection
@section('script')
        <script>
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