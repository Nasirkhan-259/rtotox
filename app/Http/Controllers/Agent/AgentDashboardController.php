<?php

namespace App\Http\Controllers\Agent;

use App\Models\Agent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AgentDashboardController extends Controller
{

    /**
     * AgentDashboardController constructor.
     */
    public function __construct()
    {

    }

    public function dashboard(Request $request)
    {
        return view('agents.dashboard');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings(Request $request)
    {
        if (\request()->isMethod('post')) {
            $post = $request->all();
            if ($post["check_settings"] == "settings") {
                $agent = $this->save_agent_settings($post);
                $success = true;
                $errors = array();
                return view('agents.settings', compact('agent', 'errors','success'));
            } elseif ($post["check_settings"] == "save_logo") {
                return $this->save_logo($request);
            } elseif ($post["check_settings"] == "change_password") {
                return $this->change_password($request);
            }
            return view('agents.settings');
        } else {
            $errors = array();
            $agent = Agent::where('id', Auth::guard('agent')->id())->first();
            return view('agents.settings', compact('errors','agent'));
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('agent')->logout();
        return redirect(url('agent/login'));
    }

    private function save_agent_settings(array $post)
    {
        $agent = Agent::where('id', Auth::guard('agent')->id())->first();
        $agent->web_url = $post["web_url"];
        $agent->company_name = $post["company_name"];
        $agent->first_name = $post["first_name"];
        $agent->last_name = $post["last_name"];
        $agent->about_me = $post["about_me"];
        $agent->contact_number = $post["contact_number"];
        $agent->save();
        return $agent;

    }

    private function save_logo(Request $request)
    {
        $v = Validator::make($request->all(), [
            'agent_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);
        $errors = array();

        $agent = Agent::where('id', Auth::guard('agent')->id())->first();
        if ($v->fails()) {
            $errors = $v->errors()->all();
            return view('agents.settings', compact('agent','errors'));
        } else {
            if (is_file(public_path('images/agent/' . $agent->logo))) {
               unlink(public_path('images/agent/' . $agent->logo));
            }
            $imageName = time() . '.' . $request->agent_logo->getClientOriginalExtension();
            $request->agent_logo->move(public_path('images/agent'), $imageName);
            $agent->logo = $imageName;
            $agent->save();
            $success = true;
            return view('agents.settings', compact('agent', 'errors','success'));


        }


    }

    private function change_password(Request $request)
    {
        $agent = Agent::where('id', Auth::guard('agent')->id())->first();
        $v = Validator::make($request->all(), [
            'current_password' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($v->fails()) {
            $errors = $v->errors()->all();
            return view('agents.settings', compact('agent','errors'));
        } else {
            if(password_verify($request->current_password,$agent->password)){
                $agent->password = password_hash($request->passowrd,PASSWORD_DEFAULT);
                $agent->save();
                $success = true;
                return view('agents.settings', compact('agent', 'success'));
            }else{
                $errors = ["Current password is not matched."];
                return view('agents.settings', compact('agent','errors'));
            }
        }
    }
}
