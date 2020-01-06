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
    @if (session('edit'))
    <div class='alert alert-success'><strong></strong>  تم تعديل الخيار بنجاح. </div>
    @endif
    @if (session('delete'))
    <div class='alert alert-success'><strong></strong>  تم مسح الخيار بنجاح. </div>
    @endif
    @if (session('add'))
    <div class='alert alert-success'><strong></strong>  تم إضافة الخيار بنجاح. </div>
    @endif
    <section class="content-header">
        <h1>
        تعديل الخيارات 
        <small> </small>
        </h1>
        <br>
        <a href="option/new?package_id={{$package_id}}" class="btn btn-primary">إضافة خيار</a>
    </section>
    <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title">  الخيارات  </h2><br><br>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>اسم الخيار</th>
                                <th> النص الانجليزي</th>
                                <th>  نوع الخيار</th>
                                <th> مسح</th>
                            </tr>

                         </thead>
                        <tbody id="tbody">
                            @foreach ($options as $option)
                                <tr>
                                    <td>{{$option->option}}</td>
                                    <td>{{$option->enName}}</td>
                                    <td>{{$option->type}}</td>
                                    <td>
                                        <a role="button" class="btn btn-primary" href="option/delete?id={{$option->id}}">مسح</a>
                                    </td>
                                </tr>    
                            @endforeach
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