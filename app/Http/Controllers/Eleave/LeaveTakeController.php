<?php

namespace App\Http\Controllers\Eleave;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\User\UserDepartment;
use App\Models\Eleave\LeaveDay;
use App\Models\Eleave\LeaveType;
use App\Models\Eleave\LeaveTake;
use App\Models\Eleave\LeaveNumberic;
Use App\Models\User\Menu;
Use App\Models\User\UserMenu;
use App\Http\Controllers\CheckPermissionController;
use Illuminate\Support\Facades\DB;
use App\Models\User\Role;
use Mail;



class LeaveTakeController extends Controller
{
  
    public function index()
    {
        // check userpermissio
        // $this->CheckPermission(1);
        try {
            $results = UserMenu::where('user_id',auth()->user()->id)->where('enable','1')->get()->unique('menu_id');
            foreach($results as $key => $result)
            {
                $results[$key]['name'] = Menu::select('name')->where('id',$result->menu_id)->first()->name;
                $results[$key]['link'] = Menu::select('link')->where('id',$result->menu_id)->first()->link;
            }
            $leave_takes = LeaveTake::whereRaw('(sup_approval = ? or hod_approval = ? or hoj_approval = ?) and Datediff(CURRENT_DATE(),startdate) <= ? ',array('pending','pending','pending','2'))->orderByDesc('id')->get();  

            foreach($leave_takes as $key => $leave_take)
            {
              $leave_takes[$key]['username'] = User::select('username')->where('id',$leave_take->user_id)->first()->username;
              $leave_takes[$key]['department'] = UserDepartment::select('department')->where('id',$leave_take->user_department_id)->first()->department;
              $leave_takes[$key]['name'] = LeaveType::select('name')->where('id',$leave_take->leave_type_id)->first()->name;
              $leave_takes[$key]['number_day'] = LeaveNumberic::select('number_day')->where('id',$leave_take->leave_numberic_id)->first()->number_day;
              $leave_takes[$key]['shift'] = LeaveDay::select('shift')->where('id',$leave_take->leave_day_id)->first()->shift;
                
           }

           return view('eleave.leaves.index',compact('leave_takes','results'));
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    public function create()
    {
       // check userpermissio
    //    $this->CheckPermission(1);

        $leavedays = LeaveDay::all();
        // $leavetypes = LeaveType::all();
        $leavetypes = LeaveType::select('name')->whereNotIn('name',['2 Annual','1 Annual','2 Unpaid','1 Unpaid'])->get();
        $leavenumberics = LeaveNumberic::all();
        // get user department of user 
        $split = explode(',',Auth::user()->user_department_id);
        $departments = UserDepartment::whereIn('id', $split)->get();
        $hods = collect([]);
        $supervisors  =collect([]);
        $handoverjobs  =collect([]);
        foreach ($departments as $key => $department)
        {
           
            $handoverjobs->push(User::whereRaw('FIND_IN_SET('.(int)$department->id.', user_department_id) > 0')->where('id','!=',auth()->id())->get());
            $supervisors->push(User::where('role_id',3)->whereRaw('FIND_IN_SET('.(int)$department->id.', user_department_id) > 0')->where('id','!=',auth()->id())->get());
            $hods->push(User::where('role_id',4)->whereRaw('FIND_IN_SET('.(int)$department->id.', user_department_id) > 0')->where('id','!=',auth()->id())->get());
        }
        $handoverjobs =  $handoverjobs->flatten()->unique('username');
        $supervisors =  $supervisors->flatten()->unique('username');
        $hods = $hods->flatten()->unique('username');
        
        return view('eleave.leaves.create',compact('departments','split','leavedays','leavetypes','leavenumberics','handoverjobs','supervisors','hods'));
    }

    public function store(Request $request)
    {
        // check userpermissio
        // $this->CheckPermission(1);

        $this->validate($request,[
           
            'startdate' => 'date_format:Y-m-d',
            'enddate' => 'date_format:Y-m-d',
            'reasons' =>'required',
            'hand_over_job' => 'required',
        ]);
        $leavetypes = ( LeaveType::select('id')->where('name', $request->name)->first())->id;
        $leavedays = ( LeaveDay::select('id')->where('shift', $request->shift)->first())->id;
        $leavenumberics = ( LeaveNumberic::select('id')->where('number_day', $request->number_day)->first())->id;
     
        $leave_take = array(
            'startdate' => $request->startdate,
            'enddate' => $request->enddate,
            'reasons' =>$request->reasons,
            'hand_over_job' => $request->hand_over_job,
            'date_app' => $request->date_app,
            'user_id' => auth()->id(),
            'user_department_id' =>$request->user_department_id,
            'leave_type_id' => $leavetypes,
            'leave_day_id' =>  $leavedays,
            'leave_numberic_id' => $leavenumberics,
            'sup' => $request->sup,
            'hod' => $request->hod,
           
        );
        $data = LeaveTake::create($leave_take);
        $status =$request->sup;
        $value = 'approved';
        if( $status  == null)
        {
             LeaveTake::where('id', $data->id)->update(['sup_approval' =>  $value]);
        }
        $split = explode(',',Auth::user()->user_department_id);
        $departments = UserDepartment::whereIn('id', $split)->get();
        $supervisors  =collect([]);
        $handoverjobs  =collect([]);
        foreach ($departments as $key => $department)
        {
            // $department['handoverjob'] = User::where('user_department_id',$department->id)->where('id','!=',auth()->id())->get();
            $handoverjobs->push(User::select('email')->whereIn('role_id',[2,3,4])->whereRaw('FIND_IN_SET('.(int)$department->id.', user_department_id) > 0')->where('username',$request->hand_over_job)->get());
            $supervisors->push(User::select('email')->where('role_id',3)->whereRaw('FIND_IN_SET('.(int)$department->id.', user_department_id) > 0')->where('username',$request->sup)->get());
        }
        $handoverjobs =  $handoverjobs->flatten()->unique('username');
        $supervisors =  $supervisors->flatten()->unique('username');
        // dd($handoverjobs);
        $LeaveTake = LeaveTake::where('user_id',auth()->user()->id)->latest('id')->first();
            $LeaveTake ['department'] = $LeaveTake->department->department;
            $LeaveTake ['username'] = $LeaveTake->user->username;
            $LeaveTake ['gender'] = $LeaveTake->user->gender;
            $LeaveTake ['shift'] = $LeaveTake->leave_day->shift;
            $LeaveTake ['name'] = $LeaveTake->leave_type->name;
            $LeaveTake ['number_day'] = $LeaveTake->leave_numberic->number_day;
            $LeaveTake ['hand_over_job'] = $LeaveTake->hand_over_job;
            Mail::send('eleave.leaves.leaveReport',['LeaveTake' => $LeaveTake],function($message) use ($LeaveTake,$handoverjobs,$supervisors){
                if (auth()->user()->email != null){
                    $message->to(auth()->user()->email)->subject(auth()->user()->username. 'Take Leave ');
                            foreach( $handoverjobs as $handoverjob){
                                $message->to($handoverjob->email)->subject(auth()->user()->username. 'Take Leave ');
                            }
                            foreach($supervisors as $supervisor){
                                $message->to($supervisor->email)->subject(auth()->user()->username. 'Take Leave ');
                            }
                }
                $message->cc(auth()->user()->hod_email)->subject('Take Leave');
                // $message->to(ENV('MAIL_TO'))->subject('Take Leave');
                // $message->from(ENV('MAIL_FROM'))->subject('Take Leave');
            }); 
       return redirect()->route('leave');
    }

    public function show($id)
    {
        // check userpermissio
        // $this->CheckPermission(1);
        $LeaveTake = $this->getAllUserFieldById($id);
        
        return response()->json($LeaveTake);
    }

    public function edit($id)
    {
        // check userpermissio
        // $this->CheckPermission(1);

        $leavedays = LeaveDay::all();
        // $leavetypes = LeaveType::all();
        $leavetypes = LeaveType::select('name')->whereNotIn('name',['2 Annual','1 Annual','2 Unpaid','1 Unpaid'])->get();
        $leavenumberics = LeaveNumberic::all();

        $split = explode(',',LeaveTake::find($id)->user_department_id);
        $leavetake = $this->getAllUserFieldById($id);
        $departments = UserDepartment::whereIn('id', $split)->get();
        $hods = collect([]);
        $supervisors  =collect([]);
        $handoverjobs  =collect([]);
        foreach ($departments as $key => $department)
        {
            // $department['handoverjob'] = User::where('user_department_id',$department->id)->where('id','!=',auth()->id())->get();
            $handoverjobs->push(User::whereRaw('FIND_IN_SET('.(int)$department->id.', user_department_id) > 0')->where('id','!=',$leavetake->user_id)->get());
            $supervisors->push(User::where('role_id',3)->whereRaw('FIND_IN_SET('.(int)$department->id.', user_department_id) > 0')->where('id','!=',$leavetake->user_id)->get());
            $hods->push(User::where('role_id',4)->whereRaw('FIND_IN_SET('.(int)$department->id.', user_department_id) > 0')->where('id','!=',$leavetake->user_id)->get());
        }
        $handoverjobs =  $handoverjobs->flatten()->unique('username');
        $supervisors =  $supervisors->flatten()->unique('username');
        $hods = $hods->flatten()->unique('username');
        
        return view('eleave.leaves.edit',compact('departments','leavetake','leavedays','leavetypes','leavenumberics','handoverjobs','supervisors','hods'));
    }

    public function update(Request $request, $id)
    {

        // check userpermissio
        // $this->CheckPermission(1);
        $this->validate($request,[
           
            'startdate' => 'date_format:Y-m-d',
            'enddate' => 'date_format:Y-m-d',
            'reasons' =>'required',
            
        ]);
        $leavetypes = ( LeaveType::select('id')->where('name', $request->name)->first())->id;
        $leavedays = ( LeaveDay::select('id')->where('shift', $request->shift)->first())->id;
        $leavenumberics = ( LeaveNumberic::select('id')->where('number_day', $request->number_day)->first())->id;
        $leave_take = array(
            'startdate' => $request->startdate,
            'enddate' => $request->enddate,
            'reasons' =>$request->reasons,
            'date_app' => $request->date_app,
            'leave_type_id' => $leavetypes,
            'leave_day_id' =>  $leavedays,
            'leave_numberic_id' => $leavenumberics,
            'sup' => $request->sup,
            'hod' => $request->hod,
            'hand_over_job'=>$request->hand_over_job,
        );
        LeaveTake::whereId($id)->update($leave_take);

        return redirect()->back()->with('modal_message_success', trans('messages.update_leave_taken_successfully'));
         
    }
    public function destroy($id)
    {
        // check userpermissio
        // $this->CheckPermission(1);

        LeaveTake::where('id',($id))->delete();
        return redirect('/leave');
    }
    public function update_sup_approval(Request $request, $id)
    {
        // check userpermissio
        // $this->CheckPermission(1);

         $status = $request->sup_approval; 
        $sup = LeaveTake::select('user_department_id')->where('id',$id)->first();
        if( $sup->user_department_id == auth()->user()->user_department_id){
            $result =LeaveTake::where('id',$id)->update(['sup_approval' =>$status]);
        }
        //  $result =LeaveTake::where('id',$id)->update(['sup_approval' =>$status]);
         if($result == true){ 
        	$arr = array('msg' => 'Approval Successfully!', 'sup_approval' => 'approved');
        }
          return response()->json($result);
    }
    public function update_hod_approval(Request $request, $id)
    {
         // check userpermissio
        // $this->CheckPermission(1);

         $data = 'approved';
         $result = LeaveTake::where('id',$id)->update(['hod_approval' => $data]);
        if($result){ 
        	$arr = array('msg' => 'Approval Successfully!', 'hod_approval' => 'approved');
        }
          return response()->json($arr);
         
    }
    public function update_hoj_approval(Request $request, $id)
    {
        // check userpermissio
        // $this->CheckPermission(1);

         $status = $request->hoj_approval; 
         $handoverjob = LeaveTake::select('hand_over_job','user_department_id')->where('id',$id)->first();
         if($handoverjob->hand_over_job == auth()->user()->username && auth()->user()->user_department_id ){
            $result = LeaveTake::where('id',$id)->update(['hoj_approval' =>$status]);
         }
         if($result == true){ 
        	$arr = array('msg' => 'Approval Successfully!', 'hoj_approval' => 'approved');
        }
          return response()->json($arr);
    }
    public function autocomplete(Request $request)
    {
        // check userpermissio
        // $this->CheckPermission(1);

        $data = User::select('username as name')->where("username","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);
    }
    //get all the field from table user and related table by user_id
    public function getAllUserFieldById($id)
    {
        // check userpermissio
        // $this->CheckPermission(1);

        $LeaveTake = LeaveTake::find($id);
        $split = explode(',',LeaveTake::find($id)->user_department_id);
        $departments = UserDepartment::select('department')->whereIn('id', $split)->get();
        $LeaveTake ['department'] = $departments;
        $LeaveTake ['username'] = $LeaveTake->user->username;
        $LeaveTake ['gender'] = $LeaveTake->user->gender;
        $LeaveTake ['shift'] = $LeaveTake->leave_day->shift;
        $LeaveTake ['name'] = $LeaveTake->leave_type->name;
        $LeaveTake ['number_day'] = $LeaveTake->leave_numberic->number_day;
        $LeaveTake ['hand_over_job'] = $LeaveTake->hand_over_job;
        return $LeaveTake ;
    }
    public function leaveReport()
    { 
        $LeaveTake = LeaveTake::where('user_id',auth()->user()->id)->first();
        // $LeaveTake = LeaveTake::('user_id',auth()->user()->id);
        $LeaveTake ['department'] = $LeaveTake->department->department;
        $LeaveTake ['username'] = $LeaveTake->user->username;
        $LeaveTake ['Sex'] = $LeaveTake->user->Sex;
        $LeaveTake ['shift'] = $LeaveTake->leave_day->shift;
        $LeaveTake ['name'] = $LeaveTake->leave_type->name;
        $LeaveTake ['number_day'] = $LeaveTake->leave_numberic->number_day;
        $LeaveTake ['hand_over_job'] = $LeaveTake->hand_over_job;
  
       return view('eleave.leaves.leaveReport',compact('LeaveTake'));
    }

}
