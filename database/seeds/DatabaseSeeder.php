<?php

use Illuminate\Database\Seeder;

use App\Models\User\Position;
use App\Models\User\UserDepartment;
use App\User;
use App\Models\User\Role;
use App\Models\User\Module;
use App\Models\User\Menu;
use App\Models\User\UserModule;
use App\Models\Eleave\LeaveType;
use App\Models\Eleave\LeaveDay;
use App\Models\Eleave\LeaveNumberic;
use App\Models\Eleave\LeaveTake;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $positions = [
            ['position' => 'Web Developer'],
            ['position' => 'IT Technical'],
        ];

        foreach($positions as $position)
            Position::create($position);
        
        $departments = [
            ['department' => 'Accountant'],
            ['department' => 'Destribution'],
            ['department' => 'E-commerce'],
            ['department' => 'Administrator'],
            ['department' => 'Retail']

        ];

        foreach($departments as $department)
            UserDepartment::create($department);

        $roles = [
           'Admin','user','guest'
        ];

        foreach($roles as $role)
            Role::create([
                'name' =>$role ,
            ]);

        $admin = User::create([
            'employee_id' => '001',
            'username' => 'admin', 
            'email' => 'admin@admin.com',
            'hod_email' => 'admin@demo.com',
            'phone_number' => '010777777', 
            'hod_phone' => '023888888',
            'annual_leave' =>'18',
            'date_joined' => '2019-01-01', 
            'password' => Hash::make('123'), 
            'gender' => 'Male', 
            'dob' => '1990-01-01', 
            'user_department_id' => 1, 
            'position_id' => 1, 
            'role_id' =>'1',
            'user_service_grade_id' =>1, 
            'image' => 'images/user.png'
        ]);
        $user = User::create(
            ['employee_id' => '002',
            'username' => 'user', 
            'email' => 'user@user.com',
            'hod_email' => 'user@demo.com',
            'phone_number' => '010777700', 
            'hod_phone' => '023888888',
            'annual_leave' =>'18',
            'date_joined' => '2019-01-01', 
            'password' => Hash::make('123'), 
            'gender' => 'Male', 
            'dob' => '1990-01-01', 
            'user_department_id' => 1, 
            'position_id' => 1, 
            'role_id' =>'2',
            'user_service_grade_id' =>1, 
            'image' => 'images/user.png']
        );
        $adminRole = Role::where('name' ,'admin')->first();
        $userRole = Role::where('name' ,'user')->first();

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);

        $modules = [
            ['module' => 'Eleave','link' => '/eleave','color' => '#007bff','icon' => 'fas fa-file-word' ],
            ['module' => 'ASP Service', 'link' =>'/asp','color' => '#28a745','icon' => 'fas fa-fw fa-wrench' ],
            ['module' => 'Online Training','link' => '/training','color' => '#17a2b8','icon' => 'fas fa laptop'],
            ['module' => 'Ionecard Member', 'link' => '/cardmember','color' => '#ffc107', 'icon' => 'fas fa-credit-card'],
            ['module' => 'Sale Demo', 'link' => 'saledemo','color' => '#dc3545','icon' => 'fas fa-shopping-cart'],
            ['module' => 'Staff Management', 'link' => '/user','color' => '#CC8899','icon' => 'fas fa-users'],
            ['module' => 'Online Docs','link' => null,'color' => '#D770AD','icon' => 'fas fa-book'],

        ];
        foreach($modules as $module)
            Module::create($module);
        $leavetypes =[
            ['name' => 'Annual'],
            ['name' => 'Unpaid'],
            ['name' => 'Marrige'],
            ['name' => 'Paternity'],
            ['name' => 'Maternity'],
            ['name' => 'Spaecial'],
            ['name' => 'Public Holiday'],
            ['name' => '2 Annual'],
            ['name' => '1 Annual'],
            ['name' => '2 Unpaid'],
            ['name' => '1 Unpaid'],
            ['name' => 'others'],

        ];
        foreach($leavetypes as $leavetype)
            LeaveType::create($leavetype);
        $leavedays = [
            ['shift' => 'Day'],
            ['shift' => 'Morning'],
            ['shift' => 'Afternoon'],
            
        ];
        foreach ($leavedays as $leaveday)
            LeaveDay::create($leaveday);

        $menus= [
            ['name' => 'Edit','link' => '/eleave/edit','module_id' => 1],
            ['name' => 'Delete','link' =>'/eleave/Delete','module_id' => 1],
            ['name' => 'Report','link' =>'#','module_id' => 1],
            ['name' => 'SupApproval','link' =>'#','module_id' => 1],
            ['name' => 'HodApproval','link' =>'#','module_id' => 1],
            
        ];
        foreach( $menus as $item)
            Menu::create($item);
        $takeleave =[
            ['startdate' => '2020-06-02', 'enddate' => '2020-06-04','reasons' => ' reasons of take leveave','hand_over_job' => 'user','date_app' => '2020-06-15 10:57:51','sup_approval' => 'pending','hod_approval' => 'pending','hoj_approval' => 'pending','user_id'=>'1','user_department_id' => '1','leave_type_id' => '1','leave_day_id' => '1','leave_numberic_id' => '1'],
        
        ];
        foreach($takeleave as $value)
            LeaveTake::create($value);
    
        $LeaveNumberic = [
            '0.5','1','1.5','2','2.5','3','3.5','4.5','4','5'
        ];
        foreach($LeaveNumberic as $item)
            LeaveNumberic::create([
                'number_day' =>$item ,
            ]);
    }

    
}
