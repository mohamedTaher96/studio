@extends('admin/layout/adminLayout')
@section('style')

@endsection
@section('content')
    <section id="alert">
        @if (session('edit'))
        <div class='alert alert-success'><strong></strong>  تم تعديل النص بنجاح. </div>
        @endif
    </section>
    <section class="content-header">
            
        <h1>
            صفحة {{$pageName->ar}}
            <small> </small>
        </h1>
    </section>
      <!-- Main content -->
    <section class="content">
        <div  class="form-group"> 
            <label for="sel1"> تعديل النص :</label>            
        </div>
        <div class="box">
            <div id="editor" class="box-body pad">
                <form action="update" method="post">
                @csrf
                    <textarea id="editor1" name="content" rows="10" cols="80">
                        {!!$pageArContent->content!!}
                    </textarea>
                    <hr>
                    <input type="hidden" name="id" value="{{$pageArContent->id}}">
                    <input type="submit" class="btn btn-primary" value="تعديل" id="edit">
                </form>
            </div>   
        </div>
    </section>    
@endsection
@section('script')
    <script>
        CKEDITOR.replace('content');
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