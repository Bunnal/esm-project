<?php

use Illuminate\Database\Seeder;

use App\Models\User\Position;
use App\Models\User\UserDepartment;
use App\Models\User\User;
use App\Models\User\Role;

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
            ['role' => 'Admin'],
            ['role' => 'Staff'],
            ['role' => 'Sup'],
            ['role' => 'Hod'],
        ];

        foreach($roles as $role)
            Role::create($role);

        $userAdmin = [
            ['employee_id' => '001','username' => 'admin', 'email' => 'admin@admin.com','hod_email' => 'admin@ione.com','phone_number' => '010777777', 'hod_phone' => '023888888','annual_leave' =>'18','date_joined' => '2019-01-01', 'password' => Hash::make('admin123'), 'Sex' => 'Male', 'DOB' => '1990-01-01', 'user_department_id' => 1, 'position_id' => 1, 'role_id' => 1,'user_service_grade_id' =>1, 'image' => 'images/user.png'],
            ['employee_id' => '002','username' => 'user', 'email' => 'user@user.com','hod_email' => 'user@ione.com','phone_number' => '077777777', 'hod_phone' => '023999999', 'annual_leave' =>'18','date_joined' => '2019-01-01','password' => Hash::make('user123'), 'Sex' => 'Male', 'DOB' => '1990-01-01', 'user_department_id' => 1, 'position_id' => 2, 'role_id' => 2,'user_service_grade_id' => 2, 'image' => 'images/user.png'],
          
        ];

        foreach($userAdmin as $user)
            User::create($user);
    }
}
