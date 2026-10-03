<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Profile Page (/profile) - Display demo user information.
     */
    public function profile()
    {
        $user = $this->userModel->getDemoUser();

        $data = [
            'pageTitle' => 'User Profile',
            'user'      => $user,
        ];

        return view('profile', $data);
    }
}