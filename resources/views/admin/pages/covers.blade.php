@extends('admin/layout/adminLayout')
@section('style')
    <style>
        td
        {
            padding: 12px;
        }
        img
        {
            width: 50px;
            height: 50px;
        }
    </style>
@endsection
@section('content')
    @if (session('add'))
        <div class='alert alert-success'><strong></strong>  تم إضافة الغلاف بنجاح. </div>
    @endif
    @if (session('edit'))
    <div class='alert alert-success'><strong></strong>  تم تعديل الغلاف بنجاح. </div>
    @endif
    @if (session('delete'))
        <div class='alert alert-success'><strong></strong>  تم حذف الغلاف بنجاح. </div>
    @endif
    @if (session('profile'))
    <div class='alert alert-success'><strong></strong>  تم تعديل بروفيل الشركه بنجاح. </div>
@endif
    <section class="content-header">
        <h1>
        تعديل غلاف الصفحات
        <small> </small>
        </h1>
        <br>
    </section>
    <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h2 class="box-title"> غلاف جديد  </h2>
                    <a role="button" href="cover/new/" class="btn btn-primary">إضافة غلاف</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>نوع الغلاف</th>
                                <th>الغلاف</th>
                                <th>تعديل /مسح</th>
                            </tr>

                         </thead>
                        <tbody>
                                <tr>
                                        <td>صورة ثابتة</td>
                                <td><a a target='_blank' rel='noopener noreferrer' href="{{asset('images/covers/'.$static->src)}}"><img src="{{asset('images/covers/'.$static->src)}}" ></a></td>
                                        <td>
                                            <a role="button" href="cover/edit?id=9" class="btn btn-primary">تعديل</a>
                                        </td>
                                    </tr> 
                            @foreach ($covers as $cover)
                                <tr>
                                    <td>صورة متحركة</td>
                                    <td><a a target='_blank' rel='noopener noreferrer' href="{{asset('images/covers/'.$cover->src)}}"><img src="{{asset('images/covers/'.$cover->src)}}" ></a></td>
                                    <td>
                                        <a role="button" href="cover/edit?id={{$cover->id}}" class="btn btn-primary">تعديل</a>
                                        <a role="button" href="cover/delete?id={{$cover->id}}" class="btn btn-primary">مسح</a>
                                    </td>
                                </tr>                            
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
    </section>
    <section class="content-header">
            <h1>
            تعديل بروفيل الشركة
            <small> </small>
            </h1>
            <br>
            <a class="btn btn-primary" href="cover/profile">تعديل</a>
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