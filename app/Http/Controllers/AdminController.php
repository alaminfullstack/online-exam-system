<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use App\Models\Examiner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function save_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function dashboard()
    {
        $total_student = Examiner::count();
        $total_exam = Exam::count();
        return view('backend.dashboard', compact('total_student', 'total_exam'));
    }

    public function profile_setting()
    {
        $user = Auth::user();
        return view('backend.profile_update', compact('user'));
    }

    public function update_profile(Request $request)
    {
        $admin = User::find(Auth::id());

        $validator = Validator::make($request->all(), [
            // 'current_password' => ['required', new CurrentPasswordCheck($admin)],
            'password' => 'nullable|min:8|confirmed',
        ]);

        $input = $request->only('name', 'email');

        if($request->has('password')){
            $input['password'] =  Hash::make($request->password);
        }

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {

            if ($admin->update($input)) {
                return response()->json(['success' => 'Profile Updated successfully done!']);
            } else {
                return response()->json(['error' => 'Data Does not Updated.someting went to wrong. please try again!']);
            }
        }
    }

    /**
     * logout
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }


}
