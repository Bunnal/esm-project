<?php

namespace App\Models\Eleave;

use Illuminate\Database\Eloquent\Model;

class LeaveTake extends Model
{
    public function user()
    {
        return $this->belongsto('App\Models\User\User','user_id');
    }
    public function leave_type()
    {
        return $this->belongsTo('App\Models\Eleave\LeaveType','leave_type_id');
    }
    public function leave_day()
    {
        return $this->belongsTo('App\Models\Eleave\LeaveDay','leave_day_id');
    }
    public function department()
    {
        return $this->belongsTo('App\Models\User\UserDepartment', 'user_department_id');
    }
    public function leave_numberic()
    {
        return $this->belongsTo('App\Models\Eleave\LeaveNumberic','leave_numberic_id');
    }
    public function role()
    {
        return $this->belongsTo('App\Models\User\Role', 'role_id');
        
    }
}
