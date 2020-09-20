<?php

namespace App\Http\Controllers\Agent;

use App\Mail\MailClass;
use App\Traits\Subscribed;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;

class AgentRegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a custom_trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use Subscribed;
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        dd(Auth::guard('agent')->check());
//
//
//        if (Auth::guard('agent')->check()) {
//            return redirect(url('agent/dashboard'));
//        }
    }

    public function login(Request $request)
    {
        if (\request()->isMethod('post')) {
            $post_signup = $request->input('post_signup');
            if ($post_signup) {
                return $this->register($request);
            } else {
                return $this->login_request($request);
            }
        } else {
            return view('agents.agent_login');
        }
    }

    public function login_request(Request $request)
    {
        $v = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($v->fails()) {
            $login_erros = $v->errors()->first();
        }else{
            $agent = Agent::where('email',$request->email)->first();
            if(empty($agent))
            {
                $login_erros = "Email not found";
            }else{
                if(password_verify($request->password,$agent->password))
                {
                    if(!$agent->is_email_verify)
                    {
                        $login_erros = "Your Email is not verify";
                    }elseif (!$agent->is_super_active)
                    {
                        $login_erros = "Your account is not approved yet please contact to office";
                    }elseif (!$agent->is_active){
                        $login_erros = "Your account has been deactivited";
                    }
                }else{
                    $login_erros = "Incorrect password.";
                }
            }
        }
        if(empty($login_erros))
        {
           Auth::guard("agent")->attempt(['email'=>$request->email,'password'=>$request->password]);
            return redirect('agent/dashboard');
        }else{
            return view('agents.agent_login', compact('login_erros'));
        }
    }

    public function register(Request $request)
    {
        $v = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'contact_number' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:agents'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($v->fails()) {
            $signup_erros = $v->errors()->all();
            return view('agents.agent_login', compact('signup_erros'));
        } else {
            $post_array = $request->all();
            unset($post_array["_token"]);
            unset($post_array["password_confirmation"]);
            if (!empty($post_array["subscribe_check"])) {
                $this->subscribe($post_array["email"]);
                unset($post_array["subscribe_check"]);
            }
            $post_array["agent_id"] = Uuid::generate()->string;
            $post_array["password"] = password_hash($post_array["password"],PASSWORD_DEFAULT);
            Agent::create($post_array);
            $success_signup = true;
            $objEmail = new \stdClass();
            $objEmail->subject = "Agent Registration";
            $objEmail->name = $post_array["first_name"] . " " . $post_array["last_name"];
            $objEmail->link = url("agent/verify/" . $post_array["agent_id"]);
            $objEmail->view = "email.b2b_email_verify";
            Mail::to($post_array["email"])->send(new MailClass($objEmail));
            return view('agents.agent_login', compact('success_signup'));
        }
    }

    public function verify($agent_id)
    {
        $agent = Agent::where('agent_id', $agent_id)->first();
        $agent->is_email_verify = 1;
        $agent->save();
        dd("Your account has been register successfully kindly contact to office.");
    }

}
