<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\page;
use App\client;
use App\category;
use App\images;
use App\language;
use App\order;
use App\subscribe;
use Validator;
use Response;

class userController extends Controller
{
    public function home()
    {
        // $arbicLanguage = DB::table('languages')->pluck('ar', 'key');
        // $englishLanguage = DB::table('languages')->pluck('en', 'key');
        // $covers = DB::table('covers')->where('type', 'moveable')->get();
        // $links =  DB::table('links')->get();
        // session_start();
        // if(isset($_SESSION['language']))
        // {
        //     if($_SESSION['language']=="English")
        //     {
        //         return view('user/pages/home')->with(["language"=>$englishLanguage,"covers"=>$covers,"links"=>$links]);
        //     }
        // }
        // return view('user/pages/home')->with(["language"=>$arbicLanguage,"covers"=>$covers,"links"=>$links]);
        return view('user/pages/home');
    }
    public function about()
    {
        $arbicLanguage = DB::table('languages')->pluck('ar', 'key');
        $englishLanguage = DB::table('languages')->pluck('en', 'key');
        $cover = DB::table('covers')->where('type', 'static')->first();
        $links =  DB::table('links')->get();
        $content = DB::table('pages')->where('name', 'about')->first();
        $conectClientTable = new client;
        $clients = $conectClientTable::all();
        session_start();
        if(isset($_SESSION['language']))
        {
            if($_SESSION['language']=="English")
            {
                return view('user/pages/about')->with(["links"=>$links,"cover"=>$cover,"language"=>$englishLanguage,"content"=>$content->enContent,"clients"=>$clients]);
            }
        }
        return view('user/pages/about')->with(["links"=>$links,"cover"=>$cover,"language"=>$arbicLanguage,"content"=>$content->content,"clients"=>$clients]);
    }
    public function profileDownload()
    {
        $profile = DB::table('covers')->where('type', 'profile')->first()->src;
        $file_path = public_path('files/company_profile/').$profile;
        return Response::download($file_path);
    }
    public function services()
    {
        $arbicLanguage = DB::table('languages')->pluck('ar', 'key');
        $englishLanguage = DB::table('languages')->pluck('en', 'key');
        $cover = DB::table('covers')->where('type', 'static')->first();
        $content = DB::table('pages')->where('name', 'service')->first();
        $links =  DB::table('links')->get();
        session_start();
        if(isset($_SESSION['language']))
        {
            if($_SESSION['language']=="English")
            {
                return view('user/pages/survice')->with(["links"=>$links,"cover"=>$cover,"language"=>$englishLanguage,"content"=>$content->enContent]);
            }
        }
        return view('user/pages/survice')->with(["links"=>$links,"cover"=>$cover,"language"=>$arbicLanguage,"content"=>$content->content]);
    }
    public function gallery()
    {
        $arbicLanguage = DB::table('languages')->pluck('ar', 'key');
        $englishLanguage = DB::table('languages')->pluck('en', 'key');
        $cover = DB::table('covers')->where('type', 'static')->first();
        $links =  DB::table('links')->get();
        $services = DB::table('pages')->where('name', 'services')->where('type',"en")->first();
        $connectCategoryTable = new category;
        $categories = $connectCategoryTable::all();
        session_start();
        if(isset($_SESSION['language']))
        {
            if($_SESSION['language']=="English")
            {
                return view('user/pages/gallery')->with(["links"=>$links,"cover"=>$cover,"language"=>$englishLanguage,"categories"=>$categories]);
            }
        }
        return view('user/pages/gallery')->with(["links"=>$links,"cover"=>$cover,"language"=>$arbicLanguage,"categories"=>$categories]);
    }
    public function category(Request $request)
    {
        $arbicLanguage = DB::table('languages')->pluck('ar', 'key');
        $englishLanguage = DB::table('languages')->pluck('en', 'key');
        $cover = DB::table('covers')->where('type', 'static')->first();
        $links =  DB::table('links')->get();
        $services = DB::table('pages')->where('name', 'services')->where('type',"en")->first();
        $images =  DB::table('images')->where('category_id', $request->category_id)->get();     
        $category =  DB::table('category')->where('id', $request->category_id)->first(); 
        $imageId = $request->id;
        session_start();
        if(isset($_SESSION['language']))
        {
            if($_SESSION['language']=="English")
            {
                return view('user/pages/category')->with(["imageId"=>$imageId,"links"=>$links,"cover"=>$cover,"language"=>$englishLanguage,"images"=>$images,"category"=>$category]);
            }
        }
        return view('user/pages/category')->with(["imageId"=>$imageId,"links"=>$links,"cover"=>$cover,"language"=>$arbicLanguage,"images"=>$images,"category"=>$category]);
    }
    public function contact()
    {
        $arbicLanguage = DB::table('languages')->pluck('ar', 'key');
        $englishLanguage = DB::table('languages')->pluck('en', 'key');
        $cover = DB::table('covers')->where('type', 'static')->first();
        $links =  DB::table('links')->get();
        $services = DB::table('pages')->where('name', 'services')->where('type',"en")->first();
        $body = "";
        $x=-1; $y=0;
        $packages = DB::table('packages')->get();
        session_start();
        if(isset($_SESSION['language']))
        {
            if($_SESSION['language']=='English')
            {
                foreach($packages as $package)
                {
                    $x =$x+1;
                    $options1 = DB::table('options')->where('package_id',$package->id )->where('type',"قسم 1")->get();
                    $options2 = DB::table('options')->where('package_id', $package->id)->where('type',"قسم 2")->get();
                    $body .="
                    <div class='col-xs-12 col-sm-6 col-md-4'>
                    <div class='box black-box margin-bottom'>
                        <div class='main-label'>
                            <label class='checkbox-holder'>
                                <input type='checkbox' name=\"header[]\" value='$package->enName'>
                                <span class='checkbox-icon'></span>
                                <span> $package->enName</span>
                            </label>
                        </div>
                    <div class='check-open'>";
                    foreach($options1 as $option1)
                    {
                        $body .="
                        <label class='checkbox-holder'>
                            <input type='checkbox' name=\"$package->enName[]\" value='$option1->enName'>
                            <span class='checkbox-icon'></span>
                            <span> $option1->enName</span>
                        </label>
                        ";
                    }
                        $body .=
                        "
                        <label class='checkbox-holder'>
                        <span> others </span>
                         </label>
                        <input type='text' placeholder='' name=\"$package->enName-other[]\">
     
                        <label>images Number</label>
                        <input type='number' placeholder='images Number ' name=\"$package->enName-photo[]\">
                        ";
                    foreach($options2 as $option2)
                    {
                        $body .=
                        "
                        <label class='checkbox-holder'>
                        <input type='checkbox' name=\"$package->enName[]\" value='$option2->enName' >
                        <span class='checkbox-icon'></span>
                        <span> $option2->enName</span>
                    </label> 
                    ";
                    }
                    $body .= "
                                </div>
                            </div>
                        </div>";
                }
                return view('user/pages/contact')->with(["links"=>$links,"cover"=>$cover,"language"=>$englishLanguage,"body"=>$body]);
            }else
            {
                session_destroy();
                return redirect("/contact");
            }
        }
        else
        {
            // $_SESSION['language']='Arabic';
            foreach($packages as $package)
            {
                $x =$x+1;
                $options1 = DB::table('options')->where('package_id',$package->id )->where('type',"قسم 1")->get();
                $options2 = DB::table('options')->where('package_id', $package->id)->where('type',"قسم 2")->get();
                $body .="
                <div class='col-xs-12 col-sm-6 col-md-4'>
                <div class='box black-box margin-bottom'>
                    <div class='main-label'>
                        <label class='checkbox-holder'>
                            <input type='checkbox' name=\"header[]\" value='$package->name'>
                            <span class='checkbox-icon'></span>
                            <span> $package->name</span>
                        </label>
                    </div>
                <div class='check-open'>";
                foreach($options1 as $option1)
                {
                    $body .="
                    <label class='checkbox-holder'>
                        <input type='checkbox' name=\"$package->enName[]\" value='$option1->option'>
                        <span class='checkbox-icon'></span>
                        <span> $option1->option</span>
                    </label>
                    ";
                }
                $body .=
                "
                <label class='checkbox-holder'>
                <span> أخرى </span>
                 </label>
                <input type='text' placeholder='' name=\"$package->enName-other[]\">
                <label>عدد الصور</label>
                <input type='number' placeholder='عدد الصور' name=\"$package->enName-photo[]\">
                ";
                foreach($options2 as $option2)
                {
                    $body .=
                    "
                    <label class='checkbox-holder'>
                    <input type='checkbox' name=\"$package->enName[]\" value='$option2->option' >
                    <span class='checkbox-icon'></span>
                    <span> $option2->option</span>
                    </label> 
                    ";
                }
                $body .= "
                        </div>
                    </div>
                </div>";      
            }
            return view('user/pages/contact')->with(["links"=>$links,"cover"=>$cover,"language"=>$arbicLanguage,"body"=>$body]);
        }
    }
    public function contactData(Request $request)
    {
        session_start();
        $newOrder = new order;
        $validator = validator::make($request->all(),[
            'company_name'=>'required',
            'acticity'=>'required',
            'contact_number'=>'required',
            'email'=>'required|email',
        ]);
        if($validator->fails())
        {
            if($_SESSION['language']=='English')
            {
                return back()->with(['enError'=>'true']);
            }else
            {
                return back()->with(['arError'=>'true']);
            }
            
        }
        if($request->hasFile('file'))
        {
            $getFileName = time().".".$request->file->getClientOriginalExtension();
            $request->file->move(public_path('images/orders'), $getFileName);
            $newOrder->file = $getFileName;
        }else
        {
            $newOrder->file ="none";
        }
        $content = "";

        if(isset($request->header))
        {
            for ($i=0 ; $i<count($request->header);$i++)
            {
                $content .="<h4 style='color:red'><u>". $request->header[$i]." :</u></h4>";
                $content .= "<ul>";
                if(isset($_SESSION['language']))
                {
                    if($_SESSION['language']!='English')
                    {
                        $package = DB::table('packages')->where("name",$request->header[$i])->first();
                        $header = $package->enName;
                        
                    }else
                    {
                        $header = $request->header[$i];
                    }
                }
                else
                {
                    $package = DB::table('packages')->where("name",$request->header[$i])->first();
                    $header = $package->enName;
                    
                }
                $photo = $header."-photo";
                $other = $header."-other";
                if(isset($request->$header))
                {
                    
                    foreach($request->$header as $item)
                    {
                        $content .= "<li style='color:blue'><h4>".$item. "<h4/></li>";
                    }
                }
                $content .= "<li style='color:blue'><h4>   عدد الصور : ".$request->$photo[0]. " <h4/></li>";
                $content .= "<li style='color:blue'><h4>  أخري : ".$request->$other[0]. " <h4/></li>";
                $content .= "</ul>";
                $newOrder->order = $content;
                $newOrder->company_name = $request->company_name;
                $newOrder->activity = $request->acticity;
                $newOrder->contact_number = $request->contact_number;
                $newOrder->email = $request->email;
                $newOrder->view = 0;
                $newOrder->save();
    
            }
        }else
        {
            if($_SESSION['language']=='English')
            {
                return back()->with(['enDataError'=>'true']);
            }else
            {
                return back()->with(['arDataError'=>'true']);
            }
        }
        if(isset($_SESSION['language']))
        {
            if($_SESSION['language']=='English')
            {
                return back()->with(['enSuccess'=>'true']);
            
            }
        }
        else
        {
            return back()->with(['arSuccess'=>'true']);
        }
        
        
    }

    public function language(Request $request)
    {
        session_start();
        $_SESSION['language']="$request->language";
        return back();
    }
    public function subscribe(Request $request)
    {
        session_start();
        $validator = validator::make($request->all(),[
            'email' => 'required|email',
        ]);
        if($validator->fails())
        {
            if($_SESSION['language']=='English')
            {
                return back()->with(['enSubError'=>'true']);
            }else
            {
                return back()->with(['arSubError'=>'true']);
            }
        }else
        {
            $newUser = new subscribe;
            $newUser->email = $request->email;
            $newUser->save();
            if($_SESSION['language']=='English')
            {
                return back()->with(['enSubscribe'=>'true']);
            }else
            {
                return back()->with(['arSubscribe'=>'true']);
            }
        }

        
    }

}
