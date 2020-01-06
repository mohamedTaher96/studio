<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Passwords\CanResetPassword;
use App\page;
use App\client;
use App\category;
use App\images;
use App\link;
use App\cover;
use App\option;
use App\package;
use App\order;
use App\language;
use App\subscribe;
use App\export;
use App\admin;
use App\permision;
use App\admin_permision;
use Validator;
use Mail;
use Response;
use PDF;
use Session;

class adminController extends Controller
{
    public function adminLogin()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            return redirect('admin');
        }else
        {
            return view('admin/pages/login');
        }
    }
    public function adminLogout()
    {
        session_start();
        session_destroy();
        return redirect('admin/login');
    }
    public function adminCheck(Request $request)
    {
        $admin = DB::table('admins')->where('email', $request->email)->first();
        if($admin)
        {
            if(Hash::check($request->password, $admin->password))
            {
                session_start();
                $_SESSION['id']=$admin->id;
                return redirect('admin');
            }
        }
        return back()->with(['error'=>'true']);
    }
    public function adminProfile()
    {
        session_start();
         
        if(isset($_SESSION['id']))
        {     
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $admins = new admin;
            $find_admin = $admins::find($_SESSION['id']);
            $admin_permisions = $find_admin->permisions()->orderBy('name')->get();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view('admin/pages/adminProfile')->with(["admin_permisions"=>$admin_permisions, "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
        
    }
    public function home()
    {
        session_start();        
        if(isset($_SESSION['id']))
        {
            $new_admin = new admin;
            $admin = $new_admin::find($_SESSION['id']); 
            $admin_permisions=$admin->permisions()->orderBy('name')->get();
            Session::flush();
            foreach($admin_permisions as $admin_permision)
            {
                Session::put("$admin_permision->name", $admin_permision);
            }
            $categoryNo = DB::table('category')->count();
            $imageNo = DB::table('images')->count();
            $clientNo = DB::table('clients')->count();
            $subscriberNo = DB::table('subscribes')->count();
            $packageNo = DB::table('packages')->count();
            $adminsNo = DB::table('admins')->count();        
            $unread = DB::table('orders')->where('view', 0)->count();
            return view('admin/pages/home')->with([ "adminsNo"=>$adminsNo,"admin"=>$admin,"unread"=>$unread,"categoryNo"=>$categoryNo,"imageNo"=>$imageNo,"clientNo"=>$clientNo,"subscriberNo"=>$subscriberNo,"packageNo"=>$packageNo]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function editPages()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view('admin/pages/editPages')->with([ "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function pageContent()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $about_us = DB::table('languages')->where('key', 'about')->first();
            $pages = DB::table('pages')->get();
            $html = "";
            foreach($pages as $page)
            {
                $pageName = DB::table('languages')->where('key', $page->name)->first();
                $html .= 
                "<tr>
                    <td>$pageName->ar</td>
                    <td><a  class='btn btn-primary' href='edit/ar?id=$page->id'>تعديل</a></td>
                    <td><a role='button' class='btn btn-primary' href='edit/en?id=$page->id'>تعديل</a></td>
                ";
            }
            return view('admin/pages/pageContent')->with(['html'=>$html, "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }

    public function arContent(Request $request)
    {
        session_start();      
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $pageArContent = DB::table('pages')->where('id',$request->id)->first();
            $pageName = DB::table('languages')->where('key', $pageArContent->name)->first();
            return view('admin/pages/pageArContent')->with([ "admin"=>$admin,"unread"=>$unread,'pageArContent'=>$pageArContent,"pageName"=>$pageName]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function updateArContent(Request $request)
    {
        session_start();                 
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            DB::table('pages')->where('id', $request->id)->update(["content"=>$request->content]);
            return back()->with(["edit"=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function enContent(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $pageArContent = DB::table('pages')->where('id',$request->id)->first();
            $pageName = DB::table('languages')->where('key', $pageArContent->name)->first();
            return view('admin/pages/pageEnContent')->with([ "admin"=>$admin,"unread"=>$unread,'pageArContent'=>$pageArContent,"pageName"=>$pageName]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function updateEnContent(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            DB::table('pages')->where('id', $request->id)->update(["enContent"=>$request->content]);
            return back()->with(["edit"=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }

    public function translation()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $translations = DB::table('languages')->get();
            return view('admin/pages/translation')->with(["translations"=>$translations, "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function editTranslation(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $translation = DB::table('languages')->where('id',$request->id)->first();
            return view('admin/pages/editTranslation')->with(["translation"=>$translation, "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function updateTranslation(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $translations = new language;
            $translation = $translations::find($request->id);
            $translation->ar = $request->ar;
            $translation->en = $request->en;
            $translation->save();
            return redirect('/admin/editPages/translation\/')->with(['edit'=>'true']);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }

    public function editGeneral()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view('admin/pages/general')->with([ "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function editlinks()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $data = new link;
            $links = $data::all();
            return view('admin/pages/Links')->with(["links"=>$links, "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function oldLink(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $data = new link;
            $link = $data::find($request->id);
            return view('admin/pages/oldlink')->with(["link"=>$link, "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function newLink(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            DB::table('links')->where('id', $request->id)->update(["url"=>$request->link]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function profileCompany()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view('admin/pages/profileCompany')->with([ "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function updateProfileCompany(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $validator = validator::make($request->all(),[
                "profile"=>'required',
            ]);
            if($validator->fails())
            {
                return back()->with(["error"=>"true"]);
            }
            $getFileName = "profile.".$request->profile->getClientOriginalExtension();
            DB::table('covers')->where('type', "profile")->update(['src'=>$getFileName]);
            $mask = public_path('files/company_profile/profile*.*');
            array_map('unlink', glob($mask));
            $request->profile->move(public_path('files/company_profile/'),$getFileName);
            return redirect('/admin/editPages/others/cover\/')->with(["profile"=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function covers()
    { 
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $covers = DB::table('covers')->where('type', "moveable")->get();
            $static= DB::table('covers')->where('type', "static")->first();
            return view('admin/pages/covers')->with(['covers'=>$covers,"static"=>$static, "admin"=>$admin,"unread"=>$unread]);

        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function addCover()
    { 
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $unread = DB::table('orders')->where('view', 0)->count();
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            return view('admin/pages/newCover')->with([ "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function newCover(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $validator = validator::make($request->all(),[
                'cover' => 'required|mimes:jpeg,png,jpg,gif,svg',
            ]);
            if($validator->fails())
            {
                return back()->with(['error'=>'true']);
            }else
            {
                // rename image name or file name 
                $getimageName = time().'.'.$request->cover->getClientOriginalExtension();
                $request->cover->move(public_path('images/covers'), $getimageName);
                $connectCoverTable = new cover;
                $connectCoverTable->type = "moveable";
                $connectCoverTable->src = $getimageName ;
                $connectCoverTable->save();
                return redirect('/admin/editPages/others/cover\/')->with('add', 'true');
            }
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function deleteCover(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $connectCoverTable = new cover;
            $cover = $connectCoverTable::find($request->id);
            $file_path = public_path().'/images/covers/'.$cover->src;
            unlink($file_path);
            $cover->delete();
            return back()->with(["delete"=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function editCover(Request $request)
    { 
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view('admin/pages/editCover')->with(["id"=>$request->id, "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function updateCover(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصفحات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $connectCoverTable = new cover;
            $cover = $connectCoverTable::find($request->id);
            $validator = validator::make($request->all(),[
                'cover' => 'required|mimes:jpeg,png,jpg,gif,svg',
            ]);
            if($validator->fails())
            {
                return back()->with(['error'=>'true']);
            }else
            {
                // rename image name or file name 
                $getimageName = time().'.'.$request->cover->getClientOriginalExtension();
                $file_path = public_path()."/images/covers/".$cover->src;
                unlink($file_path);
                $request->cover->move(public_path('images/covers'), $getimageName);
                DB::table('covers')->where('id', $request->id)->update(["src"=>$getimageName]);
                return redirect('/admin/editPages/others/cover\/')->with(['edit'=>"true"]);
            }
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }

    public function other()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('المشتركون')&&!Session::has('المشرفون')&&!Session::has('العملاء'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view("admin/pages/other")->with([ "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function clients()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('العملاء'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $connectClientTable = new client;
            $clients = $connectClientTable::all();
            return view("admin/pages/clients")->with(["clients"=>$clients, "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function newClient()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('العملاء'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view("admin/pages/newClient")->with([ "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function addClient(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('العملاء'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $validator = validator::make($request->all(),[
                'logo' => 'required|mimes:jpeg,png,jpg,gif,svg',
                'name' => 'required',
                'email' => 'required',
            ]);
            if($validator->fails())
            {
                return back()->with(['error'=>'true']);
            }else
            {
                // rename image name or file name 
                $getimageName = time().'.'.$request->logo->getClientOriginalExtension();
                $request->logo->move(public_path('images/clients'), $getimageName);
                $connectClientTable = new client;
                $connectClientTable->client_name = $request->name;
                $connectClientTable->client_email = $request->email;
                $connectClientTable->client_logo = $getimageName;
                $connectClientTable->save();
                return redirect('admin/other/clients\/')->with('add', 'true');
            }
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function deleteClient(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('العملاء'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $connectClientTable = new client;
            $client = $connectClientTable::find($request->id);
            $file_path = public_path().'/images/clients/'.$request->name;
            $client->delete();
            unlink($file_path);
            return back()->with(["delete"=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function editClient(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('العملاء'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $clients = new client;
            $client = $clients::find($request->id);
            return view("admin/pages/editClient")->with(['client'=>$client, "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function updateClient(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('العملاء'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $connectClientTable = new client;
            $client = $connectClientTable::find($request->id);
            $validator = validator::make($request->all(),[
                'logo' => 'required|mimes:jpeg,png,jpg,gif,svg',
                'name' => 'required',
                'email' => 'required',
            ]);
            if($validator->fails())
            {
                return back()->with(['error'=>'true']);
            }else
            {
                $file_path = public_path()."/images/clients/".$client->client_logo;
                unlink($file_path);
                $getimageName = time().'.'.$request->logo->getClientOriginalExtension();
                $request->logo->move(public_path('images/clients'), $getimageName);
                $client->client_name = $request->name;
                $client->client_email = $request->email;
                $client->client_logo = $getimageName;
                $client->save();
    
                return redirect('admin/other/clients\/')->with('edit', 'true');
            }
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }

    public function gallery()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصور والتصنيفات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $connectCategoryTable = new category;
            $categories = $connectCategoryTable::all();
            $body="";
            foreach($categories as $category)
            {
                $images = DB::table('images')->where('category_id', $category->id)->count();
                $body .= "
                <tr>
                <td> $category->name </td>
                <td> <a target='_blank' rel='noopener noreferrer' href='localhost:8000/images/categories/".$category->category_img."'><img src='http://localhost:8000/images/categories/".$category->category_img."' ></a> </td>
                <td ><a target='_blank' rel='noopener noreferrer' href='category/images?category_id=$category->id '> صورة : $images </a></td>
                <td>$category->created_at </td>
                <td><a role='button' class='btn btn-primary' href='category/edit?id=$category->id'>تعديل</a >
                    <a role='button' class='btn btn-primary' onclick= 'return confirm(\"are you sure you want to delete this category : $category->name\")' href='category/delete?id=$category->id&name=$category->category_img'>مسح</a>
             </td>
            </tr>
                ";
            }
            return view('admin/pages/gallery')->with(["categories"=>$body, "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function newCategoy()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصور والتصنيفات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view('admin/pages/newCategory')->with([ "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function addCategoy(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصور والتصنيفات'))
            {
                return view('admin/pages/access') ;
            }
            $validator = Validator::make($request->all(), [
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif',
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->with(['error'=>'true']);
            }else
            {
                $getimageName = time().'.'.$request->logo->getClientOriginalExtension();
                $request->logo->move(public_path('images/categories'), $getimageName);
                $connectClientTable = new category;
                $connectClientTable->name = $request->name;
                $connectClientTable->category_img = $getimageName;
                $connectClientTable->save();
                return  redirect("/admin/gallery/category\/")
                ->with(['add'=>"true"]); 
            }
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function deleteCategoy(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصور والتصنيفات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $connectCategoryTable = new category;
            $category = $connectCategoryTable::find($request->id);
            $categoryImages =  DB::table('images')->where('category_id', $category->id)->get();
            $file_path = public_path()."/images/categories/".$request->name;
            unlink($file_path);
            foreach($categoryImages as $item)
            {
                $file_path = public_path()."/images/category_images/".$item->src;
                unlink($file_path);
            }
            $category->delete();
            $category->images()->delete();
            return  redirect("/admin/gallery/category\/")
            ->with(['delete'=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function editCategoy(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصور والتصنيفات'))
            {
                return view('admin/pages/access') ;
            }
            $unread = DB::table('orders')->where('view', 0)->count();
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $connectCategoryTable = new category;
            $category = $connectCategoryTable::find($request->id);
            return view('admin/pages/editCategory')->with(["category"=>$category, "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function updateCategoy(Request $request)
    { 
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصور والتصنيفات'))
            {
                return view('admin/pages/access') ;
            }
            $connectCategoryTable = new category;
            $category = $connectCategoryTable::find($request->id);
            $validator = validator::make($request->all(), [
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg ',
                'name' => 'required',
            ]);
            if($validator->fails())
            {
                return back()->with(['error'=>'true']);
            }else
            {
                // rename image name or file name 
                $getimageName = time().'.'.$request->logo->getClientOriginalExtension();
                $file_path = public_path()."/images/categories/".$category->category_img;
                unlink($file_path);
                $request->logo->move(public_path('images/categories'), $getimageName);
                DB::table('category')->where('id', $request->id)->update(["category_img"=>$getimageName]);
                return redirect('/admin/gallery/category\/')->with(['edit'=>"true"]);
            }
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function CategoyImages(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصور والتصنيفات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $categoryName = DB::table('category')->where('id', $request->category_id)->first();
            $categoryImages =  DB::table('images')->where('category_id', $request->category_id)->get();
            return view('admin/pages/category_images')->with([ "admin"=>$admin,"unread"=>$unread,"images"=>$categoryImages,"category"=>$categoryName]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function images()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصور والتصنيفات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $connectImagesTable = new images;
            $images = $connectImagesTable::all();
            $body = "";
            foreach($images as $image)
            {
                $categoryName =  DB::table('category')->where('id', $image->category_id)->first();
                $body .= "
                <tr>
                <td>$categoryName->name </td>
                <td> <a target='_blank' rel='noopener noreferrer'  href='http://localhost:8000/images/category_images/".$image->src."'><img src='http://localhost:8000/images/category_images/".$image->src."'></a></td>
                <td>$image->created_at</td>
                <td>
                    <a role='button' class='btn btn-primary' onclick='return confirm(\"are you sure you want to delete this image\")' href='delete?id=$image->id'>delete</a>
             </td>
            </tr>";
            }
            return view('admin/pages/images')->with(["images"=>$body, "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function newImage()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصور والتصنيفات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $connectCategoryTable = new category;
            $categories = $connectCategoryTable::all();
            return view('admin/pages/newImage')->with(["categories"=>$categories, "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function addImage(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصور والتصنيفات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $validator = validator::make($request->all(),[
                'images' => 'required',
                'images.*' => 'mimes:jpeg,png,jpg,gif,svg',
            ]);
        if($validator->fails())
        {
            return back()->with(['error'=>'true']);
        }else
        {
            if(count($request->images)>0)
            {
                foreach($request->file('images') as $image)
                {
                    $getimageName = time().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path('images/category_images'), $getimageName);
                    $connectImagesTable = new images;
                    $connectImagesTable->category_id = $request->category;
                    $connectImagesTable->src = $getimageName;
                    $connectImagesTable->save();
                    sleep(1);
                }
            }
            return redirect("/admin/gallery/category/images?category_id=$request->category")->with(["add"=>"true"]);
        }
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function deleteImage(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الصور والتصنيفات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $connectImageTable = new images;
            $image = $connectImageTable::find($request->id);
            $file_path = public_path()."/images/category_images/".$image->src;
            $image->delete();
            unlink($file_path);
            return  redirect("/admin/gallery/category/images?category_id=$image->category_id")
            ->with(['delete'=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function orders()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرزم والخيارات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view("admin/pages/orders")->with([ "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function options(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرزم والخيارات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $options = DB::table('options')->where('package_id',$request->id)->get();
            return view("admin/pages/options")->with(["options"=>$options,"package_id"=>$request->id,"admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }  
    public function newOption()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرزم والخيارات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $packages = DB::table('packages')->get();
            return view("admin/pages/newOption")->with(["packages"=>$packages,"admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function addOption(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرزم والخيارات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $addOption = new option;
            $addOption->option = $request->arOption;
            $addOption->enName = $request->enOption;
            $addOption->type = $request->type;
            $addOption->package_id = $request->package_id;
            $addOption->save();
            return redirect("/admin/orders/packages/oprions?id=$request->package_id")->with(["add"=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function deleteOption(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $newOption = new option;
            $option = $newOption::find($request->id);
            $option->delete();
            return back()->with(["delete"=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function packages()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرزم والخيارات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $packages = DB::table('packages')->get();
            return view("admin/pages/packages")->with(["packages"=>$packages,"admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }

    public function newPackage()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرزم والخيارات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view("admin/pages/newPackage")->with(["admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function addPackage(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرزم والخيارات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $addPackage = new package;
            $addPackage->name = $request->arPackage;
            $addPackage->enName = $request->enPackage;
            $addPackage->save();
            return redirect("/admin/orders/packages\/")->with(["add"=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function deletePackage(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرزم والخيارات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $newPackage = new package;
            $package = $newPackage::find($request->id);
            $package->delete();
            $package->options()->delete();
            return redirect("/admin/orders/packages\/")->with(["delete"=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function editPackage(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرزم والخيارات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $package = DB::table('packages')->where('id', $request->id)->first();
            return view("admin/pages/editPackage")->with(["package"=>$package,"admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function updatePackage(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرزم والخيارات'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $Packages = new package;
            $package = $Packages::find($request->id);
            $package->name = $request->arPackage;
            $package->enName = $request->enPackage;
            $package->save();
            return redirect("/admin/orders/packages\/")->with(["edit"=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function messages()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرسائل'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $messages = DB::table('orders')->orderBy('created_at', 'desc')->get();
            return view("admin/pages/messages")->with(["messages"=>$messages,"admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function showMessage(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرسائل'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            DB::table('orders')->where('id',$request->id)->update(['view'=>1]);
            $messages = DB::table('orders')->where('id',$request->id)->first();
            return view("admin/pages/eachMessage")->with(["messages"=>$messages,"admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function replyMessage(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرسائل'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $message = DB::table('orders')->where('id',$request->id)->first();
            return view("admin/pages/replyMessage")->with(["message"=>$message,"admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function deleteMessage(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرسائل'))
            {
                return view('admin/pages/access') ;
            }
            $new_order = new order;
            $order = $new_order::find($request->id);
            if($order->file != "none")
            {
                $file_path = public_path()."/images/orders/".$order->file;
                unlink($file_path);
            } 
            $order->delete();
            return redirect("/admin/messages\/")->with(["delete"=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function deleteMessages(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرسائل'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $new_order = new order;
            foreach($request->deleteArray as $item)
            {
                $order = $new_order::find($item);
                if($order->file != "none")
                {
                    $file_path = public_path()."/images/orders/".$order->file;
                    unlink($file_path);
                } 
                $order->delete();
            }
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function downloadFile(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرسائل'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $message = DB::table('orders')->where('id',$request->id)->first();
            $file_path = public_path()."/images/orders/".$message->file;
            return Response::download($file_path);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function sendMessage(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرسائل'))
            {
                return view('admin/pages/access') ;
            }
            $email = $request->email;
            $company_name = $request->name;
            $export = new export;
            $export->company_name = $company_name;
            $export->email = $email;
            $export->content = $request->content;
            if($request->hasFile('file'))
            {
                $file = $request->file('file');
                Mail::send(['text'=>'mail'],["files"=>$file,"email"=>$email,'content'=>$request->content],function($message) use($email,$file){
                    $message->to($email)->subject('studio');
                    $message->from('goman2013@gmail.com');
                    $message->attach($file->getRealPath(), array(
                        'as' => $file->getClientOriginalName(), // If you want you can chnage original name to custom name      
                        'mime' => $file->getMimeType())
                    );
                });  
            }else
            {
                Mail::send(['text'=>'mail'],["email"=>$email,'content'=>$request->content],function($message) use($email){
                    $message->to($email)->subject('studio');
                    $message->from('goman2013@gmail.com');
                });
            }
            if($request->hasFile('file'))
            {
                $getName = time().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('images/exports'), $getName);
                $export->file = $getName;
            }
            $export->save();
            return  redirect("/admin/messages/order?id=$request->id")->with(['sent'=>'true']);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function subscribers()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('المشتركون'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $subscribers = DB::table('subscribes')->get();
            return view("admin/pages/subscribers")->with(['subscribers'=>$subscribers,"admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function newSubscriber()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('المشتركون'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view("admin/pages/newSubscriber")->with(['unread'=>$unread,"admin"=>$admin]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function addSubscriber(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('المشتركون'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $newSubscriber = new subscribe;
            $newSubscriber->email = $request->email;
            $newSubscriber->save();
            return redirect('/admin/other/subscribers\/')->with(['add'=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function deleteSubscriber(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('المشتركون'))
            {
                return view('admin/pages/access') ;
            }
            $newSubscriber = new subscribe;
            $subscriber = $newSubscriber::find($request->id);
            $subscriber->delete();
            return redirect('/admin/other/subscribers\/')->with(['delete'=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function sub_sendMessage()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('المشتركون'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view("admin/pages/sub_sendMessage")->with(["admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function sub_message_send(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('المشتركون'))
            {
                return view('admin/pages/access') ;
            }
            $subscribers = DB::table('subscribes')->get();
            if($request->hasFile('file'))
            {
                foreach($subscribers as $subscriber)
                {
                    $email = $subscriber->email;
                    $file = $request->file('file');
                    Mail::send(['text'=>'mail'],["files"=>$file,"email"=>$email,'content'=>$request->content],function($message) use($email,$file){
                        $message->to($email)->subject('studio');
                        $message->from('goman2013@gmail.com');
                        $message->attach($file->getRealPath(), array(
                            'as' => $file->getClientOriginalName(), // If you want you can chnage original name to custom name      
                            'mime' => $file->getMimeType())
                        );
                    });                 
                }
     
            }else
            {
                foreach($subscribers as $subscriber)
                {
                    $email = $subscriber->email;
                    Mail::send(['text'=>'mail'],["email"=>$email,'content'=>$request->content],function($message) use($email){
                        $message->to($email)->subject('studio');
                        $message->from('goman2013@gmail.com');
                    }); 
                }
            }
            return  back()->with(['sent'=>'true']);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }

    public function exports()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرسائل'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            $exports = DB::table('exports')->orderBy('created_at', 'desc')->get();
            return view("admin/pages/exports")->with(["exports"=>$exports,"admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function eachExport(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرسائل'))
            {
                return view('admin/pages/access') ;
            }
            $unread = DB::table('orders')->where('view', 0)->count();
            $export = DB::table('exports')->where('id',$request->id)->first();
            return view("admin/pages/eachExport")->with(["export"=>$export,"admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function downloadFileExport(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرسائل'))
            {
                return view('admin/pages/access') ;
            }
            $export = DB::table('exports')->where('id',$request->id)->first();
            $file_path = public_path()."/images/exports/".$export->file;
            return Response::download($file_path);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function deleteExportMessage(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرسائل'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $new_export = new export;
            $export = $new_export::find($request->id);
            if($export->file != "none")
            {
                $file_path = public_path()."/images/exports/".$export->file;
                unlink($file_path);
            } 
            $export->delete();
            return redirect("/admin/messages/exports\/")->with(["delete"=>"true"]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function deleteExportMessages(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرسائل'))
            {
                return view('admin/pages/access') ;
            }
            $new_export = new export;
            foreach($request->deleteArray as $item)
            {
                $export = $new_export::find($item);
                if($export->file != "none")
                {
                    $file_path = public_path()."/images/exports/".$export->file;
                    unlink($file_path);
                } 
                $export->delete();
            }
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }

    public function pdfview(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('الرسائل'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $item = DB::table("orders")->where('id',$request->id)->first();
            view()->share('item',$item);
    
            if($request->has('download')){
                $pdf = PDF::loadView('pdfview');
                return $pdf->download('pdfview.pdf');
            }
            return view('pdfview');
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function admins()
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('المشرفون'))
            {
                return view('admin/pages/access') ;
            }
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $admins = DB::table('admins')->get();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view('admin/pages/admins')->with(["admins"=>$admins,"admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
    }
    public function adminProfiles(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {      
            if(!Session::has('المشرفون'))
            {
                return view('admin/pages/access') ;
            } 
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $admin_profile = DB::table('admins')->where('id', $request->id)->first();
            $admins = new admin;
            $find_admin = $admins::find($request->id);
            $admin_permisions = $find_admin->permisions()->orderBy('name')->get();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view('admin/pages/adminProfiles')->with(["admin_permisions"=>$admin_permisions,"admin"=>$admin,"admin_profile"=>$admin_profile,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
        
    }
    public function newAdmin()
    {
        session_start();
        if(isset($_SESSION['id']))
        {      
            if(!Session::has('المشرفون'))
            {
                return view('admin/pages/access') ;
            } 
            $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
            $unread = DB::table('orders')->where('view', 0)->count();
            return view('admin/pages/newAdmin')->with([ "admin"=>$admin,"unread"=>$unread]);
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
        
    }
    public function addAdmin(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {   
            if(!Session::has('المشرفون'))
            {
                return view('admin/pages/access') ;
            }
            $validator = validator::make($request->all(),[
                '*'=>'required',
                'email'=>'required|email',
                // 'phone'=>'integer',
                'photo'=>'image|mimes:jpeg,png,jpg,gif,'
            ]);
            if($validator->fails())
            {
                return back()->with(['error'=>'true']);
            }else
            {
                if(DB::table('admins')->where('email', $request->email)->first())
                {
                    return back()->with(['email_error'=>"true"]);
                }else
                {
                    if($request->password!=$request->rePassword)
                    {
                        return back()->with(['password_error'=>'true']);
                    }else
                    {
                        $new_admin = new admin;
                        $new_admin->first_name = $request->first_name;
                        $new_admin->last_name = $request->last_name;
                        $new_admin->email = $request->email;
                        $new_admin->state = $request->state;
                        $new_admin->birth = $request->birth;
                        $new_admin->job = $request->job;
                        $new_admin->phone = $request->phone;
                        $new_admin->password = Hash::make($request->password);
                        if($request->hasFile('photo'))
                        {
                            $file = $request->file('photo');
                            $getName = time().'.'.$file->getClientOriginalExtension();
                            $file->move(public_path('images/admin'), $getName);
                            $new_admin->photo = $getName;
                            $new_admin->save();
                        }else
                        {
                            $new_admin->photo ="none.jpg";
                            $new_admin->save();
                        }
                        $admin = DB::table('admins')->where('email', $request->email)->first();
                        foreach($request->roles as $role)
                        {
                            $admin_permision = new admin_permision;
                            $admin_permision->admin_id = $admin->id;
                            $admin_permision->permision_id = $role;
                            $admin_permision->save();
                        }
                        return redirect('/admin/other/admins\/')->with(['success'=>'true']);
                    }
                }
            }
            
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }
        
    }
    public function deleteAdmin(Request $request)
    {
        session_start();
         
        if(isset($_SESSION['id']))
        {
            if(!Session::has('المشرفون'))
            {
                return view('admin/pages/access') ;
            }
            if($request->id=="9")
            {
                return redirect('/admin/other/admins\/')->with(["noDelte"=>"true"]);
            }else
            {
                $admins = new admin;
                $admin = $admins::find($request->id);
                if($admin->photo!="none.jpg")
                {
                    $imagePath = public_path("images/admin/$admin->photo");
                    unlink($imagePath);
                }
                $admin->delete();
                $admin->admin_permisions()->delete();
                return back()->with(['delete'=>'true']);
                }
            }else
            {
                return redirect('admin/login')->with(['error'=>'true']);
            }  
    }
    public function editAdmin(Request $request)
    {
        session_start();
        if(isset($_SESSION['id']))
        {
            if(!Session::has('المشرفون'))
            {
                return view('admin/pages/access') ;
            }
            if($request->id=="9")
            {
                return redirect('/admin/other/admins\/')->with(["noEdit"=>"true"]);
            }else
            {
                $admin = DB::table('admins')->where('id', $_SESSION['id'])->first();
                $old_data = DB::table('admins')->where('id', $request->id)->first();
                $unread = DB::table('orders')->where('view', 0)->count();
                return view('admin/pages/editAdmin')->with(['admin'=>$admin,'unread'=>$unread,"old_data"=>$old_data]);
            }
            }else
            {
                return redirect('admin/login')->with(['error'=>'true']);
            }  
    }
    public function updateAdmin(Request $request)
    {
        session_start();   
        if(isset($_SESSION['id']))
        {
            if(!Session::has('المشرفون'))
            {
                return view('admin/pages/access') ;
            }
            if($request->id=="9")
            {
                return redirect('/admin/other/admins\/')->with(["noEdit"=>"true"]);
            }else
            {
                $validator = validator::make($request->all(),[
                    '*'=>'required',
                    'email'=>'required|email',
                    // 'phone'=>'integer',
                    'photo'=>'image|mimes:jpeg,png,jpg,gif,'
                ]);
                if($validator->fails())
                {
                    return back()->with(['error'=>'true']);
                }else
                {
                        if($request->password!=$request->rePassword)
                        {
                            return back()->with(['password_error'=>'true']);
                        }else
                        {
                            $new_admin = new admin;
                            $admin = $new_admin::find($request->id);
                            $admin->first_name = $request->first_name;
                            $admin->last_name = $request->last_name;
                            $admin->email = $request->email;
                            $admin->state = $request->state;
                            $admin->birth = $request->birth;
                            $admin->job = $request->job;
                            $admin->phone = $request->phone;
                            $admin->password = Hash::make($request->password);
                            if($request->hasFile('photo'))
                            {
                                if($admin->photo!="none.jpg")
                                {
                                    $imagePath=public_path("images/admin/$admin->photo");
                                    unlink($imagePath);
                                }
                                $file = $request->file('photo');
                                $getName = time().'.'.$file->getClientOriginalExtension();
                                $file->move(public_path('images/admin'), $getName);
                                $admin->photo = $getName;
                                $admin->save();
                            }else
                            {
                                if($admin->photo!="none.jpg")
                                {
                                    $imagePath=public_path("images/admin/$admin->photo");
                                    unlink($imagePath);
                                }
                                $admin->photo ="none.jpg";
                                $admin->save();
                            }
                            $admin_id = DB::table('admins')->where('email', $admin->email)->first();
                            DB::table('admin_permisions')->where('admin_id', $admin->id)->delete();
                            foreach($request->roles as $role)
                            {
                                $admin_permision = new admin_permision;
                                $admin_permision->admin_id = $admin_id->id;
                                $admin_permision->permision_id = $role;
                                $admin_permision->save();
                            }
                            return redirect('/admin/other/admins\/')->with(['edit'=>'true']);
                        }
                }
            }
        }else
        {
            return redirect('admin/login')->with(['error'=>'true']);
        }  
    }

}

