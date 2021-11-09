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
use App\Models\User\UserServiceGrade;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

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
            ['name' => 'Disapproval','link' =>'#','module_id' => 1],
            ['name' => 'Approval','link' =>'#','module_id' => 1],
            
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

        // position
        $positions = [
            ['position'=>'Managing Director'],
            ['position'=>'Sales Executive'],
            ['position'=>'Business Manager'],
            ['position'=>'Office Manager'],
            ['position'=>'Driver'],
            ['position'=>'Retail Supervisor'],
            ['position'=>'Procurement Executive'],
            ['position'=>'Senior Technician'],
            ['position'=>'Senior Customer Service'],
            ['position'=>'Graphic Designer'],
            ['position'=>'Consultant'],
            ['position'=>'Channel  Sales Manager'],
            ['position'=>'Accounting Manager'],
            ['position'=>'Retail Associate'],
            ['position'=>'Stock Controller'],
            ['position'=>'Senior Graphic Designer'],
            ['position'=>'Cleaner'],
            ['position'=>'Customer Service'],
            ['position'=>'Associate HR Manager'],
            ['position'=>'Apple Technician'],
            ['position'=>'PSP Supervisor'],
            ['position'=>'Trainer'],
            ['position'=>'Associate Business Manager'],
            ['position'=>'Warehouse Supervisor'],
            ['position'=>'Group Technical Supervisor'],
            ['position'=>'Product Specialist'],
            ['position'=>'Sales Engineer'],
            ['position'=>'Inventory Executive'],
            ['position'=>'Sale Manager'],
            ['position'=>'Sale Representative'],
            ['position'=>'Delivery Man'],
            ['position'=>'Marketing Executive'],
            ['position'=>'Account Assistant'],
            ['position'=>'Chanel Supervisor'],
            ['position'=>'Phillip Technician'],
            ['position'=>'Mechanician'],
            ['position'=>'HR Executive'],
            ['position'=>'Stock Controller'],
            ['position'=>'Admin Assistant'],
            ['position'=>'Admin Executive'],
            ['position'=>'Marketing Coordinator'],
            ['position'=>'IT Support'],
            ['position'=>'Receptionist'],
            ['position'=>'Accounts Executive'],
            ['position'=>'Consultant'],
            ['position'=>'Retail Associate (Part Time)'],
            ['position'=>'Associate Warehouse Manager'],
            ['position'=>'Corporate Sales'],
            ['position'=>'Senior Customer Service'],
            ['position'=>'Web developer (Part Time)'],
            ['position'=>'Officer'],
            ['position'=>'Associate Sales Manager'],
            ['position'=>'Brand Executive'],
            ['position'=>'Security'],
            ['position'=>'IT Supervisor'],
            ['position'=>'Marketing Support'],
            ['position'=>'E-Commerce Coordinator'],
            ['position'=>'Director'],
            ['position'=>'Product Executive'],
            ['position'=>'Finance Manager'],
            ['position'=>'Inventory Executive'],
            ['position'=>'Infrastructure Manager'],
            ['position'=>'Security Manager'],
            ['position'=>'Business Executive'],
            ['position'=>'Applicant Development Leader'],
            ['position'=>'Retail Associate/PIC'],
            ['position'=>'Bill Collector'],
            ['position'=>'Event Marketing'],
            ['position'=>'Network Engineer'],
            ['position'=>'Card Merchant Executive'],
            ['position'=>'Web Developer'],
            ['position'=>'Associate Products Manager']
        ];
        foreach($positions as $position)
            Position::create($position);

         // department 
        $departments = [
            ['department' => 'PSP'],
            ['department' => 'Distribution'],
            ['department' => 'Account'],
            ['department' => 'Ecommerce'],
            ['department' => 'Admin / HR / Logistics'],
            ['department' => 'Cloud Infra'],
            ['department' => 'Building & Leasing'],
            ['department' => 'Retail'],
            ['department' => 'Other'],
            ['department' => 'Enterprise Sales'],
        ];

        foreach($departments as $department)
            UserDepartment::create($department);
        // user grade 
        $userServiceGrade = [
            ['service_grade' => 'AT1'],
            ['service_grade' => 'AT2'],
            ['service_grade' => 'AT3'],
            ['service_grade' => 'EX1'],
            ['service_grade' => 'EX2'],
            ['service_grade' => 'EX3'],
            ['service_grade' => 'MN1'],
            ['service_grade' => 'MN2'],
            ['service_grade' => 'MN3'],
            ['service_grade' => 'GMI1'],
            ['service_grade' => 'GMI2'],
            ['service_grade' => 'GMI3'],
        ];
        foreach ($userServiceGrade as $key => $servicegrade) {
            UserServiceGrade::create($servicegrade);
        }

        // user database seeding 
        $users = [
            ['employee_id' => '003', 'username' =>'003', 'email' =>'003@gmail.com', 'hod_email' =>'headofdepartment@gmail.com', 'phone_number' =>'087010110', 'hod_phone' =>'087010111', 'annual_leave' =>'18', 'date_joined' =>'2018-07-03', 'password' => Hash::make('123'), 'gender' =>'other', 'dob' =>'1997-04-04', 'user_department_id' => 3, 'position_id' =>70, 'role_id' =>'2', 'user_service_grade_id' =>4, 'status' =>'enable', 'image' =>NULL],
            ['employee_id' => '004', 'username' =>'004', 'email' =>'004@gmail.com', 'hod_email' =>'headofdepartment@gmail.com', 'phone_number' =>'087010111', 'hod_phone' =>'087010111', 'annual_leave' =>'18', 'date_joined' =>'2018-07-03', 'password' => Hash::make('123'), 'gender' =>'other', 'dob' =>'1997-04-04', 'user_department_id' => 3, 'position_id' =>56, 'role_id' =>'2', 'user_service_grade_id' =>1, 'status' =>'enable', 'image' =>NULL],
            ['employee_id' => '005', 'username' =>'005', 'email' =>'005@gmail.com', 'hod_email' =>'headofdepartment@gmail.com', 'phone_number' =>'087010112', 'hod_phone' =>'087010111', 'annual_leave' =>'18', 'date_joined' =>'2018-07-03', 'password' => Hash::make('123'), 'gender' =>'other', 'dob' =>'1997-04-04', 'user_department_id' => 3, 'position_id' =>57, 'role_id' =>'2', 'user_service_grade_id' =>6, 'status' =>'enable', 'image' =>NULL],
            ['employee_id' => '006', 'username' =>'006', 'email' =>'006@gmail.com', 'hod_email' =>'headofdepartment@gmail.com', 'phone_number' =>'087010113', 'hod_phone' =>'087010111', 'annual_leave' =>'18', 'date_joined' =>'2018-07-03', 'password' => Hash::make('123'), 'gender' =>'other', 'dob' =>'1997-04-04', 'user_department_id' => 3, 'position_id' =>60, 'role_id' =>'4', 'user_service_grade_id' =>7, 'status' =>'enable', 'image' =>NULL],
            ['employee_id' => '007', 'username' =>'007', 'email' =>'007@gmail.com', 'hod_email' =>'headofdepartment@gmail.com', 'phone_number' =>'087010114', 'hod_phone' =>'087010111', 'annual_leave' =>'18', 'date_joined' =>'2018-07-03', 'password' => Hash::make('123'), 'gender' =>'other', 'dob' =>'1997-04-04', 'user_department_id' => 3, 'position_id' =>6, 'role_id' =>'1', 'user_service_grade_id' =>5, 'status' =>'enable', 'image' =>NULL],
            ['employee_id' => '008', 'username' =>'008', 'email' =>'008@gmail.com', 'hod_email' =>'headofdepartment@gmail.com', 'phone_number' =>'087010115', 'hod_phone' =>'087010111', 'annual_leave' =>'18', 'date_joined' =>'2018-07-03', 'password' => Hash::make('123'), 'gender' =>'other', 'dob' =>'1997-04-04', 'user_department_id' => 3, 'position_id' =>6, 'role_id' =>'2', 'user_service_grade_id' =>1, 'status' =>'enable', 'image' =>NULL],
            ['employee_id' => '009', 'username' =>'009', 'email' =>'009@gmail.com', 'hod_email' =>'headofdepartment@gmail.com', 'phone_number' =>'087010116', 'hod_phone' =>'087010111', 'annual_leave' =>'18', 'date_joined' =>'2018-07-03', 'password' => Hash::make('123'), 'gender' =>'other', 'dob' =>'1997-04-04', 'user_department_id' => 3, 'position_id' =>71, 'role_id' =>'2', 'user_service_grade_id' =>4, 'status' =>'enable', 'image' =>NULL],
            ['employee_id' => '010', 'username' =>'010', 'email' =>'010@gmail.com', 'hod_email' =>'headofdepartment@gmail.com', 'phone_number' =>'087010117', 'hod_phone' =>'087010111', 'annual_leave' =>'18', 'date_joined' =>'2018-07-03', 'password' => Hash::make('123'), 'gender' =>'other', 'dob' =>'1997-04-04', 'user_department_id' => 3, 'position_id' =>10, 'role_id' =>'2', 'user_service_grade_id' =>3, 'status' =>'enable', 'image' =>NULL],
            ['employee_id' => '011', 'username' =>'011', 'email' =>'011@gmail.com', 'hod_email' =>'headofdepartment@gmail.com', 'phone_number' =>'087010118', 'hod_phone' =>'087010111', 'annual_leave' =>'18', 'date_joined' =>'2018-07-03', 'password' => Hash::make('123'), 'gender' =>'other', 'dob' =>'1997-04-04', 'user_department_id' => 3, 'position_id' =>16, 'role_id' =>'2', 'user_service_grade_id' =>4, 'status' =>'enable', 'image' =>NULL],
            ['employee_id' => '012', 'username' =>'012', 'email' =>'012@gmail.com', 'hod_email' =>'headofdepartment@gmail.com', 'phone_number' =>'087010119', 'hod_phone' =>'087010111', 'annual_leave' =>'18', 'date_joined' =>'2018-07-03', 'password' => Hash::make('123'), 'gender' =>'other', 'dob' =>'1997-04-04', 'user_department_id' => 3, 'position_id' =>71, 'role_id' =>'2', 'user_service_grade_id' =>1, 'status' =>'enable', 'image' =>NULL]
        ];
        foreach ($users as $key => $user) {
            User::create($user);
        }

        //user link menu 
        $userLinkMenus = [
            ["user_id" => '3', "menu_id" => '5',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '3', "menu_id" => '4',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '4', "menu_id" => '5',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '4', "menu_id" => '4',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '5', "menu_id" => '5',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '5', "menu_id" => '4',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '7', "menu_id" => '5',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '7', "menu_id" => '4',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '8', "menu_id" => '5',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '8', "menu_id" => '4',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '9', "menu_id" => '5',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '9', "menu_id" => '4',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '10', "menu_id" => '5',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '10', "menu_id" => '4',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '11', "menu_id" => '5',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '11', "menu_id" => '4',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '12', "menu_id" => '5',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '12', "menu_id" => '4',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '6', "menu_id" => '1',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '6', "menu_id" => '2',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '6', "menu_id" => '3',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '6', "menu_id" => '4',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '6', "menu_id" => '5',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '6', "menu_id" => '6',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
            ["user_id" => '6', "menu_id" => '7',"enable" => '1',"view" => '1',"create" => '1',"edit" => '1',"delete" => '1',],
        ];
    }

    
}
