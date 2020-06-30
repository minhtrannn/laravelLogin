<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('dashboard');
    }

    public function inforView()
    {
        $user = auth()->user();
        return view('updateInfor')->with('user',$user);
    }
    public function update(Request $request,$id)
    {
        // $id = $request->input('id');

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'cover_image' => 'required|nullable|image|max:1999',
        ]);

        //validate file 
        if($request->hasFile('cover_image'))
        {
            $type = $request->file('cover_image')->getClientMimeType();
            $imgType = explode('/',$type);
            $fileType = $imgType['0'];
            $fileExt = $imgType['1'];
            $arrayType = array('jpg','jpeg','png');
            $fileName = $request->file('cover_image')->getClientOriginalName();
            $fileName = pathinfo($fileName,PATHINFO_FILENAME);
            if(in_array($fileExt,$arrayType) && $fileType === 'image')
            {
                //File name to store
                $fileNameToStore = $fileName . '_' . time() . '.' . $fileExt;
            }
            else 
            {
                $fileNameToStore = 'noimage.png';
            }
        }
        else 
        {
            $fileNameToStore = 'noimage.png';
        }
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $path = $request->file('cover_image')->storeAs('public/cover_images',$fileNameToStore);
        $user->cover_image = $fileNameToStore;
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return redirect("/infor/". $id);
    }
    public function home(){
        $data = User::all();
        dd($data);
    }
}