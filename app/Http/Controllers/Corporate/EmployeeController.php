<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Mail\MailClass;
use App\Models\Corporate\CorporateDepartment;
use App\Models\Corporate\CorporateEmployee;
use App\Models\Corporate\CorporateFamily;
use App\Models\Corporate\CorporatePolicy;
use App\Models\Corporate\CorporateWorkFlow;
use App\Models\CorporateBranch;
use App\Models\CorporateCostCenter;
use App\Models\CorporateDestination;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    //

    /**
     * DepartmentsController constructor.
     */
    public function __construct()
    {
    }
    public function index()
    {
        $employee = DB::table("corporate_employees")
            ->join('corporate_branch', 'corporate_branch.id', '=', 'corporate_employees.corporate_branchid')
            ->join('corporate_department', 'corporate_department.id', '=', 'corporate_employees.department')
            ->join('corporate_destination', 'corporate_destination.id', '=', 'corporate_employees.designation')
            ->select('corporate_branch.name as branch_name','corporate_department.name as dept_name','corporate_destination.name as designation_name', "corporate_employees.*")
            ->where('corporate_employees.corporate_id',Auth::guard('corporate')->user()->corporate_id)->where('is_admin',0)->orderBy('id', 'DESC')->get();
        $departements = CorporateDepartment::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $destinations = CorporateDestination::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $levels = CorporatePolicy::where("corporate_id",Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        $branches = CorporateBranch::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        return view('corporate.employee',compact('employee','departements','branches','destinations','levels'));
    }
    public function filter_employees(Request $request)
    {
        $employee = DB::table("corporate_employees")
            ->join('corporate_branch', 'corporate_branch.id', '=', 'corporate_employees.corporate_branchid')
            ->join('corporate_department', 'corporate_department.id', '=', 'corporate_employees.department')
            ->join('corporate_destination', 'corporate_destination.id', '=', 'corporate_employees.designation')
            ->select('corporate_branch.name as branch_name','corporate_department.name as dept_name','corporate_destination.name as designation_name', "corporate_employees.*")
            ->where('corporate_employees.corporate_id',Auth::guard('corporate')->user()->corporate_id)->where('is_admin',0);
        if(!empty($request->Branch))
        {
            $employee->where('corporate_employees.corporate_branchid',$request->Branch);

        }
        if(!empty($request->EmployeeName))
        {
            $employee->where('corporate_employees.id',$request->EmployeeName);

        }
        if(!empty($request->Department))
        {
            $employee->where('corporate_employees.department',$request->Department);

        }
        if(!empty($request->Level))
        {
            $employee->where('corporate_employees.policy_id',$request->Level);

        }
        if(!empty($request->EmployeeType))
        {
            if($request->EmployeeType == "is_apporver")
                $employee->where('corporate_employees.is_approver',1 );

            if($request->EmployeeType == "is_booker")
                $employee->where('corporate_employees.is_booker',1 );
        }
        $Branch = $request->Branch;
        $Department = $request->Department;
        $EmployeeType = $request->EmployeeType;
        $Level = $request->Level;
        $employee = $employee->orderBy('id', 'DESC')->get();
        $departements = CorporateDepartment::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $destinations = CorporateDestination::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $levels = CorporatePolicy::where("corporate_id",Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        $branches = CorporateBranch::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        return view('corporate.employee',compact('employee','departements','branches','destinations','levels','Branch','Department','EmployeeType','Level'));
    }

    /**
     * For Select2 autocomplete
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $employee = DB::table('corporate_employees')
            ->select(
                "corporate_employees.id",
                "corporate_employees.travelpolicy",
                "corporate_employees.firstname",
                "corporate_employees.lastname",
                "corporate_employees.email",
                "corporate_employees.flexcostcentre",
                "corporate_employees.costcentreid",
                "corporate_cost_center.name as cost_center_name")
            ->where("email", "LIKE", "%".$request->q."%")
            ->where("corporate_employees.corporate_id", Auth::guard('corporate')->user()->corporate_id)
            ->join('corporate_cost_center', 'corporate_employees.costcentreid', '=', 'corporate_cost_center.id')
            ->get();

        return response()->json($employee);
    }
    public function search_name(Request $request)
    {
        $employee = DB::table('corporate_employees')
            ->select(
                "corporate_employees.id",
                "corporate_employees.firstname",
                "corporate_employees.lastname")
            ->where("email", "LIKE", "%".$request->q."%")
            ->where("is_admin", 0)
            ->orWhere("firstname", "LIKE", "%".$request->q."%")
            ->orWhere("lastname", "LIKE", "%".$request->q."%")
            ->get();
        return response()->json($employee);
    }

    public function employee(Request $request)
    {
        $departements = CorporateDepartment::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $costcenter = CorporateCostCenter::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $destination = CorporateDestination::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $employees_doctor = CorporateEmployee::where("employee_type","Doctor")->where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        if($employees_doctor->isEmpty())
        {
            $employees_doctor = CorporateEmployee::where("is_admin","1")->where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        }

        $branch = CorporateBranch::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $levels = CorporatePolicy::where("corporate_id",Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        $workflows = CorporateWorkFlow::where("corporate_id",Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        $country = Country::all();
        $now = date('Y');
        $family = [];
        return view('corporate.add_employee',compact('destination','costcenter','departements','branch','now','country','family','levels','workflows','employees_doctor'));
    }
    public function add(Request $request)
    {
        $result = $request->all();

        $corporate_employee = CorporateEmployee::where("email",$result["employee"]["email"])->first();
        if(!empty($corporate_employee))
        {
            return array("status"=>false,"message"=>"Email Must Be Unique");

        }
        $corporate = new CorporateEmployee();

        if($result['employee']['role_id'] == 'Approver'){
            $isapprover = 1;
        }else{
            $isapprover = 0;
        }

        if($result['employee']['role_id'] == 'Booker'){
            $isbooker = 1;
        }else{
            $isbooker = 0;
        }

        if($result['employee']['role_id'] == 'Traveller'){
            $istraveler = 1;
        }else{
            $istraveler = 0;
        }
        if(!empty($result['employee']['costenable'])){
            $costenable = 1;
        }else{
            $costenable = 0;
        }
        if(!empty($result['employee']['allow_personal_travel'])){
            $allow_personal_travel = 1;
        }else{
            $allow_personal_travel = 0;
        }
        if(!empty($result['employee']['create_own_trip'])){
            $create_own_trip = 1;
        }else{
            $create_own_trip = 0;
        }

        $corporate->policy_id = $result['employee']['policy_id'];
        $corporate->password_hash = $this->randomPassword();
        $corporate->password = bcrypt($corporate->password_hash );
        $corporate->isActive = $result['employee']['isActive'];
        $corporate->workflow_id = $result['employee']['workflow_id'];
        $corporate->employee_type = $result['employee']['employee_type'];
        $corporate->doctor_approver = $result['employee']['doctor_approver'];
        $corporate->allow_personal_travel = $allow_personal_travel;
        $corporate->employeecode = $result['employee']['employeecode'];
        $corporate->create_own_trip = $create_own_trip;
        $corporate->corporate_id =  Auth::guard('corporate')->user()->corporate_id;;
        $corporate->is_approver = $isapprover;
        $corporate->is_booker = $isbooker;
        $corporate->is_traveler = $istraveler;
        $corporate->point_of_hire = $result['employee']['point_of_hire'];
        $corporate->salutation = $result['employee']['salutation'];
        $corporate->firstname = $result['employee']['firstname'];
        $corporate->middlename = $result['employee']['middlename'];
        $corporate->lastname = $result['employee']['lastname'];
        $corporate->corporate_branchid = $result['employee']['corporate_branchid'];
        $corporate->department = $result['employee']['department'];
        $corporate->designation = $result['employee']['designation'];
        $corporate->dob = $result['employee']['day']."-".$result['employee']['month']."-".$result['employee']['year'];
        $corporate->country_of_residence = $result['employee']['country_of_residence'];
        $corporate->national_idno = $result['employee']['national_idno'];
        $corporate->costcentreid = $result['employee']['costcentreid'];
        $corporate->costenable = $costenable;
        $corporate->email = $result['employee']['email'];
        $corporate->personalemailid = $result['employee']['personalemailid'];
        $corporate->phonenumber = $result['employee']['phonenumber'];
        $corporate->phone_country_code = $result['employee']['phonecode'];
        $corporate->mobile_corporate = $result['employee']['mobilenumber'];
        $corporate->mobile_country_code = $result['employee']['mobilecode'];
        $corporate->mobile_personal = $result['employee']['personalphonenumber'];
        $corporate->personal_country_code = $result['employee']['personalphonecode'];
        $corporate->emergency_contact = $result['employee']['emergency_contact'];
        $corporate->emergencycontactno = $result['employee']['emergency_contact_number'];
        $corporate->emergency_country_code = $result['employee']['emergency_contact_code'];
        $corporate->personaladdress = $result['employee']['personaladdress'];
        $corporate->passportno = $result['employee']['passportno'];
        $corporate->passport_dateofissue = $result['employee']['issueday']."-".$result['employee']['issuemonth']."-".$result['employee']['issueyear'];
        $corporate->passport_dateofexpiry = $result['employee']['expday']."-".$result['employee']['expmonth']."-".$result['employee']['expyears'];
        $corporate->countryissue = $result['employee']['countryissue'];
        $corporate->nationality = $result['employee']['nationality'];
        $corporate->prefferred_mealplan = $result['employee']['prefferred_mealplan'];
        $corporate->save();

        //Family Data Save
        if(!empty($result['family'])){
            foreach ($result['family']['type'] as $index=>$item)
            {
                $family = new CorporateFamily();
                $family->employee_id =  $corporate->id;
                $family->type = $result['family']['type'][$index];
                $family->salutation = $result['family']['solution'][$index];
//            $family->is_active = $result['family']['available'][$index];
                $family->first_name = $result['family']['name'][$index];
                $family->middle_name = $result['family']['middlename'][$index];
                $family->last_name = $result['family']['lastname'][$index];
                $family->dob = $result['family']['date'][$index]."-".$result['family']['month'][$index]."-".$result['family']['year'][$index];
                $family->relationship = $result['family']['real'][$index];
                $family->passportno = $result['family']['passpoet'][$index];
                $family->nationality = $result['family']['nationality'][$index];
                $family->country_id = $result['family']['country'][$index];
                $family->prefferred_mealplan = $result['family']['plan'][$index];
                $family->national_idno = $result['family']['nationalityid'][$index];
                $family->save();
            }
        }


        $objEmail = new \stdClass();
        $objEmail->subject = "Employee Registration";
        $objEmail->name = $corporate->firstname . " " . $corporate->lastname;
        $objEmail->username = $corporate->email;
        $objEmail->password = $corporate->password_hash;
        $objEmail->link = url("corporate/".session('corporate')->alais);
        $objEmail->view = "email.corporate_welcome";
        Mail::to($corporate->email)->send(new MailClass($objEmail));

        return array("status"=>true);
    }
    public function edit($id)
    {
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $employee = DB::table('corporate_employees')
            ->select("corporate_employees.*","airports.cityName")
            ->where("corporate_employees.corporate_id", Auth::guard('corporate')->user()->corporate_id)
            ->where("corporate_employees.id", $id)
            ->join('airports', 'corporate_employees.point_of_hire', '=', 'airports.code')
            ->first();
        $family = CorporateFamily::where('employee_id',$id)->get();
        $departements = CorporateDepartment::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $costcenter = CorporateCostCenter::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $destination = CorporateDestination::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $employees_doctor = CorporateEmployee::where("employee_type","Doctor")->where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $employees_doctor = CorporateEmployee::where("employee_type","Doctor")->where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        if($employees_doctor->isEmpty())
        {
            $employees_doctor = CorporateEmployee::where("is_admin","1")->where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        }
        $branch = CorporateBranch::where('corporate_id',Auth::guard('corporate')->user()->corporate_id)->get();
        $levels = CorporatePolicy::where("corporate_id",Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        $workflows = CorporateWorkFlow::where("corporate_id",Auth::guard('corporate')->user()->corporate_id)->orderBy('id', 'DESC')->get();
        $country = Country::all();
        $now = date('Y');
        return view('corporate.add_employee',compact('employee','destination','costcenter','departements','branch','now','country','family','levels','workflows','employees_doctor'));
    }
    public function update(Request $request)
    {
        $result = $request->all();
        $corporate_id = Auth::guard('corporate')->user()->corporate_id;
        $corporate= CorporateEmployee::where('corporate_id',$corporate_id)->where('id',$result['employee']['id'])->first();
        $corporate_employee = CorporateEmployee::where("email",$result["employee"]["email"])->first();

        $family= CorporateFamily::where('employee_id',$result['employee']['id'])->delete();
        if(!empty($corporate_employee) && $corporate_employee->id != $result['employee']['id'])
        {
            return array("status"=>false,"message"=>"Email Must Be Unique");

        }

        if($result['employee']['role_id'] == 'Approver'){
            $isapprover = 1;
        }else{
            $isapprover = 0;
        }

        if($result['employee']['role_id'] == 'Booker'){
            $isbooker = 1;
        }else{
            $isbooker = 0;
        }

        if($result['employee']['role_id'] == 'Traveller'){
            $istraveler = 1;
        }else{
            $istraveler = 0;
        }
        if(!empty($result['employee']['costenable'])){
            $costenable = 1;
        }else{
            $costenable = 0;
        }
        if(!empty($result['employee']['allow_personal_travel'])){
            $allow_personal_travel = 1;
        }else{
            $allow_personal_travel = 0;
        }
        if(!empty($result['employee']['create_own_trip'])){
            $create_own_trip = 1;
        }else{
            $create_own_trip = 0;
        }

        $corporate->policy_id = $result['employee']['policy_id'];
        $corporate->password_hash = $result['employee']['password'];
        $corporate->password = bcrypt($corporate->password_hash );
        $corporate->isActive = $result['employee']['isActive'];
        $corporate->workflow_id = $result['employee']['workflow_id'];
        $corporate->employee_type = $result['employee']['employee_type'];
        $corporate->doctor_approver = $result['employee']['doctor_approver'];
        $corporate->allow_personal_travel = $allow_personal_travel;
        $corporate->employeecode = $result['employee']['employeecode'];
        $corporate->create_own_trip = $create_own_trip;
        $corporate->corporate_id =  Auth::guard('corporate')->user()->corporate_id;;
        $corporate->is_approver = $isapprover;
        $corporate->is_booker = $isbooker;
        $corporate->is_traveler = $istraveler;
        $corporate->point_of_hire = $result['employee']['point_of_hire'];
        $corporate->salutation = $result['employee']['salutation'];
        $corporate->firstname = $result['employee']['firstname'];
        $corporate->middlename = $result['employee']['middlename'];
        $corporate->lastname = $result['employee']['lastname'];
        $corporate->corporate_branchid = $result['employee']['corporate_branchid'];
        $corporate->department = $result['employee']['department'];
        $corporate->designation = $result['employee']['designation'];
        $corporate->dob = $result['employee']['day']."-".$result['employee']['month']."-".$result['employee']['year'];
        $corporate->country_of_residence = $result['employee']['country_of_residence'];
        $corporate->national_idno = $result['employee']['national_idno'];
        $corporate->costcentreid = $result['employee']['costcentreid'];
        $corporate->costenable = $costenable;
        $corporate->email = $result['employee']['email'];
        $corporate->personalemailid = $result['employee']['personalemailid'];
        $corporate->phonenumber = $result['employee']['phonenumber'];
        $corporate->phone_country_code = $result['employee']['phonecode'];
        $corporate->mobile_corporate = $result['employee']['mobilenumber'];
        $corporate->mobile_country_code = $result['employee']['mobilecode'];
        $corporate->mobile_personal = $result['employee']['personalphonenumber'];
        $corporate->personal_country_code = $result['employee']['personalphonecode'];
        $corporate->emergency_contact = $result['employee']['emergency_contact'];
        $corporate->emergencycontactno = $result['employee']['emergency_contact_number'];
        $corporate->emergency_country_code = $result['employee']['emergency_contact_code'];
        $corporate->personaladdress = $result['employee']['personaladdress'];
        $corporate->passportno = $result['employee']['passportno'];
        $corporate->passport_dateofissue = $result['employee']['issueday']."-".$result['employee']['issuemonth']."-".$result['employee']['issueyear'];
        $corporate->passport_dateofexpiry = $result['employee']['expday']."-".$result['employee']['expmonth']."-".$result['employee']['expyears'];
        $corporate->countryissue = $result['employee']['countryissue'];
        $corporate->nationality = $result['employee']['nationality'];
        $corporate->prefferred_mealplan = $result['employee']['prefferred_mealplan'];
        $corporate->save();

        //Family Data Save
        if(!empty($result['family']))
        {
            foreach ($result['family']['type'] as $index=>$item)
            {
                $family = new CorporateFamily();
                $family->employee_id =  $corporate->id;
                $family->type = $result['family']['type'][$index];
                $family->salutation = $result['family']['solution'][$index];
//            $family->is_active = $result['family']['available'][$index];
                $family->first_name = $result['family']['name'][$index];
                $family->middle_name = $result['family']['middlename'][$index];
                $family->last_name = $result['family']['lastname'][$index];
                $family->dob = $result['family']['date'][$index]."-".$result['family']['month'][$index]."-".$result['family']['year'][$index];
                $family->relationship = $result['family']['real'][$index];
                $family->passportno = $result['family']['passpoet'][$index];
                $family->nationality = $result['family']['nationality'][$index];
                $family->country_id = $result['family']['country'][$index];
                $family->prefferred_mealplan = $result['family']['plan'][$index];
                $family->national_idno = $result['family']['nationalityid'][$index];
                $family->save();
            }

        }
        return array("status"=>true);
    }
    public function resetPassword(Request $request)
    {
        $objEmail = new \stdClass();
        $objEmail->subject = "Employee Registration";
        $objEmail->name = $corporate->firstname . " " . $corporate->lastname;
        $objEmail->username = $corporate->email;
        $objEmail->password = $corporate->password_hash;
        $objEmail->link = url("corporate/".session('corporate')->alais);
        $objEmail->view = "email.corporate_welcome";
        Mail::to($corporate->email)->send(new MailClass($objEmail));
    }
    function randomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

}
