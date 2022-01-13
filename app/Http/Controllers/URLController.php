<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\URL;
use App\Models\opened_link;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;


class URLController extends Controller
{
    public function add(Request $request)
    {
        $validated = $request->validate(
            [
                'Real_Path' => 'required|max:2048|url',
            ],
            [
                'Real_Path.required' => 'This field is required.',
                'Real_Path.url' => 'This field  must be a valid URL.'
            ]
        );
        $new = (uniqid());
        $category = URL::insert([
            'Real_Path' => $request->Real_Path,
            'New_Path' => $new,
            'created_at' => Carbon::now()
        ]);
        return redirect()->back()->with('New_Path', $new);
    }
    public function get($id)
    {

        // echo Auth::user();
        // exit;
        $link = URL::select('*')->where('new_path', '=', $id)->get();
        if (count($link) == 0) {
            abort(404, 'Page not found');
        } else {
            if ($link[0]->password == null) {
                if($link[0]->user_id!=null){
                    opened_link::insert(
                        [
                         'url_id'=>$link[0]->id,
                         'country'=>"hello"
                        ]
                    );

                }
                return new RedirectResponse(($link[0]->Real_Path));
            }
            return redirect('password/' . $id);
        }
    }

    public function Dash_Add(Request $request)
    {
        $validated = $request->validate(
            [
                'Real_Path' => 'required|max:2048|url',
            ],
            [
                'Real_Path.required' => 'This field is required.',
                'Real_Path.url' => 'This field  must be a valid URL.'
            ]
        );
        $new = (uniqid());
        $category = URL::insert([
            'Real_Path' => $request->Real_Path,
            'title' => $request->title,
            'password' => $request->password,
            'user_id' => Auth::user()->id,
            'New_Path' => $new,
            'created_at' => Carbon::now(),
        ]);
        // echo $request->password;
        return redirect()->back()->with('New_Path', $new);
    }
    public function password($id)
    {
        return view('password', compact('id'));
    }

    public function password_check(Request $req)
    {
        $req->validate(
            ['password' => 'required']
        );


        if (($req->New_Path) != null) {
            $link = URL::select('*')->where('new_path', '=', $req->New_Path)->get();

            
            if (count($link) == 0) {
                abort(404, 'Page not found');
            } else {
                // echo "here";
                // exit;
                if ($link[0]->password == null) {
                    return new RedirectResponse(($link[0]->Real_Path));
                } else {
                    if ($link[0]->password === $req->password) {
                        if($link[0]->user_id!=null){
                            opened_link::insert(
                                [
                                 'url_id'=>$link[0]->id,
                                 'country'=>"hello"
                                ]
                            );
        
                        }
                        return new RedirectResponse(($link[0]->Real_Path));
                    } else {
                        return redirect()->back()->with('password_check', "Wrong password");
                    }
                }
            }
        } else {
            abort(404, 'Page not found');
        }
    }
    public function Dash_Link()
    {
        $links = URL::select('*')->where('user_id', '=', Auth::user()->id)->get();
        // echo $links;
        return view('dashboard.links', compact('links'));
    }
    public function Dash_Edit($id)
    {
        $links = URL::select('*')->where('new_path', '=', $id)->get();
        if (count($links) == 0) {
            abort(404, 'Page not found');
        } else {
            if ($links[0]->user_id!=Auth::user()->id) {
                abort(401, 'you are not authorized to access the wanted page');
            }
            else
            {
                $link=$links[0];
                return view('dashboard.edit',compact("link"));
            }
        }
    }
    public function Dash_Update(Request $req)
    {
        $validated = $req->validate(
            [
                'Real_Path' => 'required|max:2048|url',
            ],
            [
                'Real_Path.required' => 'This field is required.',
                'Real_Path.url' => 'This field  must be a valid URL.'
            ]
        );
        // echo $req->New_Path;
        // exit;
        $link = URL::select('*')->where('new_path', '=', $req->New_Path)->get();
        if (count($link) == 0) {
            abort(404, 'Page not found');
        } else {
            if($link[0]->user_id===Auth::user()->id){
                URL::where('new_path', '=', $req->New_Path)->update([
                    'title'=>$req->title,
                    'password'=>$req->password,
                    'Real_Path'=>$req->Real_Path,
                    'updated_At'=>Carbon::now(),
                ]);
                return redirect()->route('dashboard.links')->with('success', 'URL Updated Successfuly');
            }
            abort(401, 'you are not authorized to access the wanted page');
        }
    }
    public function Dash_Delete(Request $req)
    {
        
        $link = URL::select('*')->where('new_path', '=', $req->New_Path)->get();
        if (count($link) == 0) {
            abort(404, 'Page not found');
        } else {
            if($link[0]->user_id===Auth::user()->id){
                URL::where('new_path', '=',$req->New_Path)->delete();
                
                return redirect()->route('dashboard.links')->with('success', 'URL deleted Successfuly');
            }
            abort(401, 'you are not authorized to access the wanted page');
        }
        
    }
}
