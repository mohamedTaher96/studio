@extends('admin/layout/adminLayout')
@section('style')

@endsection
@section('content')
        <section id="alert">

                        
        </section>
        <section class="content-header">
            
                <h1>
                تعديل صفحة  خدمتنا
                <small> </small>
                </h1>
        </section>
      <!-- Main content -->
      <section class="content">

            <div  class="form-group">
                    <label for="sel1"> تعديل النص :</label>
                    <input type="button"  class="btn btn-primary language" data='ar' value="العربي">
                    <input type="button"   class="btn btn-primary language" data="en" value="الإنجليزي">               
                  </div>
            <div class="box">
                    <div id="editor" class="hide box-body pad">
                      <form>
                        @csrf
                        <textarea id="editor1" name="editor1" rows="10" cols="80">
                            
                        </textarea>
                      </form>
                      <hr>
                      <input type="button" class="btn btn-primary" value="تعديل" id="edit">
                    </div>   
                  </div>

        </section>
        
@endsection
@section('script')
    <script>
        var flag =true;
        $(".language").click(function(){
            language = $(this).attr('data');
            if(flag)
            {
                CKEDITOR.replace('editor1');
                $("#editor").removeClass("hide");
                flag = false;
            }
            $.ajax({
                url:"old",
                type:"POST",
                headers:
		        {
            		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{language:language},
                success:function(data)
                {
                    CKEDITOR.instances.editor1.setData( data );
                }
            })
        })
        $("#edit").click(function(){
            var data = CKEDITOR.instances.editor1.getData();
            $.ajax({
                url:"edit",
                type:"POST",
                headers:
		        {
            		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{language:language,data:data},
                success:function(data)
                {
                    $(".content").addClass("hide");
                    $(".content-header").addClass("hide");
                    $("#alert").html("<div class='alert alert-success'><strong></strong>  تم تعديل النص بنجاح. </div>");
                    window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                            location.assign('https://studio-20.herokuapp.com/admin/editPages');
                        });
                    }, 1000);
                    
                }
            })
        })
    </script>
@endsection