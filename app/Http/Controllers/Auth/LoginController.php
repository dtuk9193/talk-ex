<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Message;
use App\Talk;
use App\Auth;
use App\Thread;

use Illuminate\Support\Facades\View;

class NewMessage
{
    public $message;
    public function __construct($msg) {
        $this->message = $msg;
    }
}

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        
    }
    
    public function index() {
        
    }

    public function userVerified($user){
        auth()->setUser($user);
        $msg = new Message();
        $msg->set_message($user->id, '12:23:45 2019-9-12', 'jony', '192.168.0.16', 'Hi, davit');
        $messages = new NewMessage($msg);
        View::composer('partials.peoplelist', function($view) {
            $messages2 = new Message();
            $messages2->set_message(auth()->user()->id, '12:23:45 2019-9-12', 'jony', '192.168.0.16', 'Hi, davit');
            $thread = new Thread(auth()->user(), $messages2);
            
            $threads = new Talk($thread);
            
            $view->with(compact('threads'));
        });

        return view('messages/conversations', compact('messages', 'user'));
    }

    public function loginUser() {
        if( array_key_exists('email', $_REQUEST) ) {
            $email = $_REQUEST['email'];
        }
        if( array_key_exists('password', $_REQUEST) ) {
            $password = $_REQUEST['password'];
        }
        $userlist = DB::table('users')->get();
        foreach($userlist as $users){
            if($users->email == $email && $users->password == $password){
                $user = User::find($users->id);
                return $this->userVerified($user);
                //return redirect('/checked');
            }
        }
        return redirect()->guest('login');
    }
}

