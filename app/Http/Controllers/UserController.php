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
            'name' => ['required','regex:/^[a-zA-Z][a-zA-Z\s]*$/'],
            'email' => ['required','regex:/^[a-z][a-z0-9_\.]{5,32}@[a-z0-9]{2,}(\.[a-z0-9]{2,4}){1,2}$/'],
            'password' => ['required','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/'],
            'cover_image' => 'required|nullable|image|max:1999',
        ]);

        if(auth()->user()->email === $request->input('email'))
        {
            return redirect('/infor/{{auth()->user()->id}}')->with('error','New email cannot be same old email!!!');
        }
        else if(auth()->user()->name === $request->input('name'))
        {
            return redirect('/infor/{{auth()->user()->id}}')->with('error','New name cannot be same old name!!!');
        }

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