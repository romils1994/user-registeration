<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Session;
use App\Models\User;
use Hash;


class AuthController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        if(Auth::check()){
            $userDetArr = Auth::user();
            $data = [
                'username' => $userDetArr->username,
                'firstname' => $userDetArr->firstname,
                'lastname' => $userDetArr->lastname,
                'email' => $userDetArr->email
            ];
            $redirect = 'dashboard';
            if (!$data['firstname'] || !$data['lastname'] || !$data['email']) {
                $redirect = 'details';
            }
            return redirect()->intended($redirect);
        }
        return view('auth.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function details()
    {
        if(Auth::check()){
            $userDetails = Auth::user();
            $data = [
                'userid' => $userDetails->id,
                'username' => $userDetails->username,
                'firstname' => $userDetails->firstname,
                'lastname' => $userDetails->lastname,
                'email' => $userDetails->email
            ];

            $filename = 'word-counter-files/' . $userDetails->id . '.txt';
            $s3Storage = Storage::disk('s3');
            if ($s3Storage->has($filename)) {
                $data['wordCount'] = str_word_count($s3Storage->get($filename));
            }
            return view('detail',$data);
        }

        return redirect("login")->withSuccess('Oops! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $userDetArr = Auth::user();
            $data = [
                'username' => $userDetArr->username,
                'firstname' => $userDetArr->firstname,
                'lastname' => $userDetArr->lastname,
                'email' => $userDetArr->email
            ];
            $redirect = 'dashboard';
            if (!$data['firstname'] || !$data['lastname'] || !$data['email']) {
                $redirect = 'details';
            }
            return redirect()->intended($redirect);
        }

        return redirect('login')->withSuccess('Oops! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {
        $request->validate([
            'username' => 'required|max:255|unique:users',
            'password' => 'required|min:6'
        ]);

        $data = $request->all();
        $check = $this->create($data);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $userDetArr = Auth::user();
            $data = [
                'username' => $userDetArr->username,
                'firstname' => $userDetArr->firstname,
                'lastname' => $userDetArr->lastname,
                'email' => $userDetArr->email
            ];
            $redirect = 'dashboard';
            if (!$data['firstname'] || !$data['lastname'] || !$data['email']) {
                $redirect = 'details';
            }
            return redirect()->intended($redirect);
        }

        return redirect('login')->withSuccess('Oops! You have entered invalid credentials');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postDetails(Request $request)
    {
        $request->validate([
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email|max:255',
            'textfile' => 'mimetypes:text/plain|mimes:txt'
        ]);

        if ($request->hasFile('textfile')) {
            $file = $request->file('textfile');
            $name = Auth::user()->id . '.txt';
            $filePath = 'word-counter-files/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
        }

        $data = $request->all();
        $check = $this->update($data);

        return redirect('dashboard');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){
            $userDetails = Auth::user();
            $data = [
                'username' => $userDetails->username,
                'firstname' => $userDetails->firstname,
                'lastname' => $userDetails->lastname,
                'email' => $userDetails->email,
            ];
            $filename = 'word-counter-files/' . $userDetails->id . '.txt';
            $s3Storage = Storage::disk('s3');
            if ($s3Storage->has($filename)) {
                $data['wordCount'] = str_word_count($s3Storage->get($filename));
            }

            return view('dashboard',$data);
        }

        return redirect("login")->withSuccess('Oops! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password'])
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function update(array $data)
    {
        $userDetails = Auth::user();
        $user = User::find($userDetails->id);
        $user->firstname = ucfirst($data['firstname']);
        $user->lastname = ucfirst($data['lastname']);
        $user->email = $data['email'];
        $user->save();
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
