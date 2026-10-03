<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data['users'] = $this->userModel->findAll();
        return view('users/index', $data);
    }

    public function new()
    {
        helper(['form']);
        return view('users/new');
    }

    public function create()
    {
        helper(['form']);

        $rules = [
            'username'  => 'required|alpha_dash|min_length[3]|max_length[30]|is_unique[users.username]',
            'full_name' => 'required|min_length[3]|max_length[100]',
            'email'     => 'required|valid_email|max_length[100]|is_unique[users.email]',
            'password'  => 'required|min_length[6]',
            'role'      => 'required|in_list[admin,manager,cashier]',
        ];

        if (! $this->validate($rules)) {
            return view('users/new', ['validation' => $this->validator]);
        }

        $this->userModel->save([
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'      => $this->request->getPost('role'),
        ]);

        return redirect()->to('/users')->with('success', 'User account created successfully.');
    }

    public function edit($id = null)
    {
        helper(['form']);
        $user = $this->userModel->find($id);

        if (! $user) {
            throw PageNotFoundException::forPageNotFound("User #{$id} not found.");
        }

        return view('users/edit', ['user' => $user]);
    }

    public function update($id = null)
    {
        helper(['form']);
        $currentUser = $this->userModel->find($id);

        $rules = [
            'username'  => "required|alpha_dash|min_length[3]|max_length[30]|is_unique[users.username,id,{$id}]",
            'full_name' => 'required|min_length[3]|max_length[100]',
            'email'     => "required|valid_email|max_length[100]|is_unique[users.email,id,{$id}]",
            'role'      => 'required|in_list[admin,manager,cashier]',
            'avatar'    => 'permit_empty|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]',
        ];

        if (! $this->validate($rules)) {
            return view('users/edit', [
                'user'       => $currentUser,
                'validation' => $this->validator,
            ]);
        }

        $avatarName = $currentUser['avatar'];
        $file = $this->request->getFile('avatar');

        // Check if an avatar was uploaded
        if ($file && $file->isValid() && ! $file->hasMoved()) {
            $newName = $file->getRandomName();
            $uploadPath = FCPATH . 'uploads/avatars';

            if (! is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }

            // Move uploaded file to uploads directory
            $file->move($uploadPath, $newName);

            // Generate display-ready thumbnail using CodeIgniter Image Service
            \Config\Services::image()
                ->withFile($uploadPath . '/' . $newName)
                ->fit(150, 150, 'center')
                ->save($uploadPath . '/' . $newName);

            // Delete old avatar file if existing
            if (! empty($currentUser['avatar']) && file_exists($uploadPath . '/' . $currentUser['avatar'])) {
                unlink($uploadPath . '/' . $currentUser['avatar']);
            }

            $avatarName = $newName;
        }

        $updateData = [
            'username'  => $this->request->getPost('username'),
            'full_name' => $this->request->getPost('full_name'),
            'email'     => $this->request->getPost('email'),
            'role'      => $this->request->getPost('role'),
            'avatar'    => $avatarName,
        ];

        if ($this->request->getPost('password')) {
            $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $updateData);

        return redirect()->to('/users')->with('success', 'User account updated successfully.');
    }
}