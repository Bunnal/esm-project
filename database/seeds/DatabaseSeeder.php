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
            'user_service_grade_id' =>1, 
            'image' => 'images/user.png']
        );
        $adminRole = Role::where('name' ,'admin')->first();
        $userRole = Role::where('name' ,'user')->first();

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
    }
}
