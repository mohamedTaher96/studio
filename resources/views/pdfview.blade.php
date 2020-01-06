<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body
        {
            border: 1px solid  black;
            padding: 10px;
        }
        .center
        {
            text-align: center;
        }
        #icon
        {
            width: 50px;
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="contain">
        <div class="center"><img id="icon" src="{{asset('images/user/icon.png')}}"></div>
        <div class="head">
            <h3>  company name : {{$item->company_name}}</h3>
            <h3>  email : {{$item->email}}</h3>
            <h3>  contact number  : {{$item->contact_number}}</h3>
        </div>
        <hr>
        <div class="center"><h3>The order</h3></div>
        <div class="container">
            {!!$item->order!!}
        </div>
        <hr>
        <div>
            @if($item->file!='none')
                <ul>
                    <li>
                        <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                        <div class="mailbox-attachment-info">
                        <a href="download?id={{$item->id}}" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i> download file</a>
                        </div>
                    </li>
                </ul>                                  
              @endif
        </div>
    </div>
</body>
</html>