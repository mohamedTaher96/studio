@extends('user/layout/arabicLayout')
@section('style')
<style>
        input[type="file"] {
            padding: 0;
        }

        .black-box.margin-bottom {
            margin: 0 0 15px;
        }

        .checkbox-holder {
            font-weight: 100;
            position: relative;
            cursor: pointer;
            margin-bottom: 10px;
            display: block;
        }

        .checkbox-holder span {
            vertical-align: middle;
        }

        .checkbox-holder .checkbox-icon {
            width: 13px;
            height: 13px;
            line-height: 7px;
            display: inline-block;
            border: 1px solid #000;
            background: #000;
            text-align: center;
            margin: 0 4px;
        }

        .checkbox-holder input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkbox-holder .checkbox-icon:after {
            content: '';
            background: #000;
            width: 7px;
            height: 7px;
            display: block;
            margin: 2px;
        }

        .checkbox-holder input[type="checkbox"]:checked + .checkbox-icon {
            border-color: #00bcd4;
        }

        .checkbox-holder input[type="checkbox"]:checked + .checkbox-icon:after {
            background: #00bcd4;
        }

        .main-label {
            border-bottom: 1px dashed #00bcd4;
        }

        .check-open {
            margin-top: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="fixed-bg">
        <img src="{{asset('images/covers/'.$cover->src)}}">
    </div>
    <div class="main-content">
            <div class="container">
                <h1 class="main-heading"> {{$language['contact']}}</h1>
                @if(session('arSuccess'))
                <div class="alert alert-success">تم إرسال طلبك بنجاح</div>
                @endif
                @if(session('arError'))
                <div class="alert alert-danger">  جميع البيانات مطلوبه </div>
                @endif
                @if(session('arSubError'))
                <div class="alert alert-danger">    البريد الالكتروني مطلوب </div>
                @endif
                @if(session('enSuccess'))
                <div class="alert alert-success">   successfuly sent</div>
                @endif
                @if(session('enError'))
                <div class="alert alert-danger">   all details are required</div>
                @endif
                @if(session('enSubError'))
                <div class="alert alert-danger">   email is required</div>
                @endif
                @if(session('enSubscribe'))
                <div class="alert alert-success">   successfuly Subscribe</div>
                @endif
                @if(session('arSubscribe'))
                <div class="alert alert-success">   تم الإشتراك بنجاح</div>
                @endif
                @if(session('enDataError'))
                <div class="alert alert-danger">   Enter the order </div>
                @endif
                @if(session('arDataError'))
                <div class="alert alert-danger">    يجب إدخال الأوردر </div>
                @endif
                <div class="row">
                    <div class="col-xs-12 col-sm-8">
                        <form action="contact/data" method="POST" enctype="multipart/form-data">
                            @csrf
                        <input type="text" name="company_name" placeholder="{{$language['company_name']}}">
                            <input type="text" name="acticity" placeholder="{{$language['activity']}}">
                            <input type="tel" name="contact_number" placeholder="{{$language['contact_number']}}">
                            <input type="email" name="email" placeholder="{{$language['email']}}">
        
        
                            <label>{{$language['service_type']}} </label>
        
                            <div class="row">
                                {!!$body!!}
                            </div>
        
        
                            <label> {{$language['send_file']}}</label>
                            <input type="file" name="file" >
                            <div class="btn btn-white btn-block">
                                <span><input type="submit" value="{{$language['send']}}"></span>
                            </div>
                        </form>
                    </div>
        
                    <div class="col-xs-12 col-sm-4">
                        <div class="box black-box text-center">
                            <h3 class="main-heading"> {{$language['contact_details']}}</h3>
        
                            <p><i class="fa fa-envelope-o right-fa"></i> {{$language['email']}}</p>
                            <p><i class="fa fa-phone right-fa"></i> {{$language['phone']}}</p>
                        </div>
                        <div class="box black-box text-center">
                            <h3 class="main-heading"> {{$language['Subscribe']}}</h3>
        
                            <form action="contact/subscribe" method="POST">
                                @csrf
                                <input type="email" name="email" placeholder=" {{$language['email']}}">
                                <div class="btn btn-white btn-block">
                                    <span><input type="submit" value=" {{$language['Subscribe']}}"></span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        
            </div>
        </div>
@endsection
@section('script')
    <script>
        active();
        function active()
        {
            $(".contact").addClass("active");
        }
        $(document).ready(function (){
            $('.check-open').slideUp(0);

            $('.main-label .checkbox-holder').click(function (){
                if($(this).find('input').is(':checked')) {
                    $(this).parents('.main-label').next('.check-open').stop().slideDown();
                } else {
                    $(this).parents('.main-label').next('.check-open').stop().slideUp();
                }
            });
        });
        if($(".alert"))
            {
                window.setTimeout(function() {
                        $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                        });
                    }, 1500);
            }

    </script>
@endsection