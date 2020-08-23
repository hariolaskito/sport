<?php

namespace App\Http\Controllers;

use Hash;
use Validator;
use Yajra\Datatables\Datatables;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Form;
use Auth;
use App\Role;

class UserController extends Controller
{
    
    public function index(){
    	$data['title'] = "Data User";
    	$data['title_desc'] = "Menampilkan semua user yang terdaftar";
    	return view('backend.user.view')->with($data);
    }

    public function show(){
        $users = User::select(['fullname', 'username', 'email', 'role','isdefault','isactive','id']);
        return Datatables::of($users)
            ->editColumn('isactive', function ($user) {
                $txstatus = "";
                if($user->isactive == 1){
                    $txstatus = "<span class='label label-success'>Aktif</span>";
                }elseif ($user->isactive == 0) {
                    $txstatus = "<span class='label label-warning'>Nonaktif</span>";
                }
                return $txstatus;
            })
            ->editColumn('id', function ($user) {
                $html = "";
                if($user->isdefault == "0"){
                    $html.= '<a href="'.route('user.edit', ['id' => $user->id]).'" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit</a>';
                    $html.= Form::open(array('route' => array('user.destroy','id' => $user->id), 'method' => 'delete', 'style' => 'display:inline;'));
                    $html.='<button type="submit" onclick="confirm(\'Do you want to delete this data?\')" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</button>';
                    $html.= Form::close();
                }
                return $html;
            })
            ->setRowId('id')
            ->make(true);
    }

    public function edit($id){
        $data['title'] = "Edit User";
        $data['title_desc'] = "Edit profil spesifik user";
        $user = User::where('id',$id)->first();
        if($user->birthdate != "0000-00-00"){
            $user->birthdate = date("d-m-Y",strtotime($user->birthdate));
        }else{
            $user->birthdate = "";
        }
        $data['user'] = $user;
        return view('backend.user.edit')->with($data);
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'username' => 'required|unique:user,username,'.$id.',id|min:4',
            'email' => 'required|email|unique:user,email,'.$id.',id',
            'phone' => 'required|unique:user,phone,'.$id.',id|max:15'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = array(
                'role' => $request->role,
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'isactive' => $request->isactive
            );
        User::where('id',$id)->update($data);
        $user = User::where('id',$id)->first();
        $user->detachRoles($user->roles);
        $role = Role::where('name',$request->role)->first();
        $user->roles()->attach($role->id);

        $data = array();
        $data['response_status'] = 1;
        $data['response_message'] = 'User was successfully update';
        return redirect()->route('user.index')->with($data);
    }

    public function create(){
    	$data['title'] = "Tambah User Baru";
    	$data['title_desc'] = "";
    	return view('backend.user.create')->with($data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
        	'fullname' => 'required',
            'username' => 'required|unique:user,username|min:4',
            'email' => 'required|email|unique:user,email',
            'phone' => 'required|unique:user,phone|max:15'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
        	$user = new User;
        	$user->fullname = $request->fullname;
        	$user->username = $request->username;
        	$user->role = $request->role;
        	$user->email = $request->email;
        	$user->phone = $request->phone;
            $user->isactive = $request->isactive;
        	$user->isdefault = '0';
        	$user->password = Hash::make($request->password);
        	$user->save();

            $role = Role::where('name',$request->role)->first();
            $user->roles()->attach($role->id);

            $data['response_status'] = 1;
        	$data['response_message'] = 'User was successfully created';
        	return redirect()->route('user.index')->with($data);
        }
    }

    public function destroy($id){
        $user = User::where('id',$id)->first();
        $user->detachRoles($user->roles);
        $user->delete();

        $data['response_status'] = 1;
        $data['response_message'] = 'User was successfully deleted';
        return redirect()->route('user.index')->with($data);
    }

    public function edit_pass(){
        $data['title'] = "Ubah Password";
        $data['title_desc'] = "Ubah Password";

        $user = User::where('id',Auth::user()->id)->first();
        $data['user'] = $user;
        return view('backend.user.change_pass')->with($data);

    }

    public function update_pass(Request $request){
        $user = User::where('id',Auth::user()->id)->first();
        if(count($user) > 0){
            if (Hash::check($request->oldpass, $user->password)){
                $data = array(
                    'password' => Hash::make($request->newpass),
                );
                User::where('id',Auth::user()->id)->update($data);
                return redirect()->route('user.logout');
            }else{
                $data['response_status'] = 0;
                $data['response_message'] = 'Password lama yang anda masukkan tidak cocok';
                return redirect()->route('user.edit_pass')->with($data);
            }
        }else{
            $data['response_status'] = 0;
            $data['response_message'] = 'User tidak ditemukan';
            return redirect()->route('user.edit_pass')->with($data);
        }
    }
	
	public function login(Request $request){
		$username = $request->username;
		$password = $request->password;
        //return redirect()->route('user.index');
		if (Auth::attempt(array('username' => $username, 'password' => $password, 'isactive' => '1', 'role' => 'admin'), false)){
			return redirect()->route('user.index');
		}elseif(Auth::attempt(array('username' => $username, 'password' => $password, 'isactive' => '1', 'role' => 'operator'), false)){
            return redirect()->route('user.index');
        }else{
        	$data['response_status'] = 0;
        	$data['response_message'] = "Username atau password salah";
            $data['response_hash'] = Hash::make($password);
			return redirect()->back()->with($data);
		}
	}

    public function login_member(Request $request){
        $username = $request->username;
        $password = $request->password;
        if (Auth::attempt(array('username' => $username, 'password' => $password, 'isactive' => '1', 'role' => 'member'), false)){
            return redirect()->route('front.home');
        }else{
            return redirect()->back();
        }
    }

    public function register_member(Request $request){
        $validator = Validator::make($request->all(), [
            'fullname' => 'required',
            'username' => 'required|unique:user,username|min:4',
            'email' => 'required|email|unique:user,email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }else{
            $user = new User;
            $user->fullname = $request->fullname;
            $user->username = $request->username;
            $user->role = "member";
            $user->email = $request->email;
            $user->phone = "";
            $user->isactive = "1";
            $user->password = Hash::make($request->password);
            $user->save();

            $role = Role::where('name',"member")->first();
            $user->roles()->attach($role->id);
            Auth::attempt(array('username' => $user->username, 'password' => $request->password, 'isactive' => 1, 'role' => 'member'));
            $data['response_status'] = 1;
            $data['response_message'] = 'User was successfully created';
            return redirect()->route('front.home');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('adminpage');
    }

    public function logout_member(){
        Auth::logout();
        return redirect()->route('front.home');
    }
}
