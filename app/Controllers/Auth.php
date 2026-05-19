<?php
namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    public function login()
    {
        if ($this->request->getMethod() === 'POST') {
            $username = trim((string) $this->request->getPost('username'));
            $password = (string) $this->request->getPost('password');
            $user = (new AuthModel())->findByUsername($username);
            $valid = false;
            if ($user) {
                $hash = $user['password'] ?? '';
                $valid = password_verify($password, $hash) || $password === $hash;
            }
            if ($valid) {
                session()->set([
                    'logged_in' => true,
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'fullname' => $user['fullname'] ?: $user['username'],
                    'role' => $user['role'] ?? 'user',
                ]);
                return redirect()->to('/dashboard');
            }
            return view('auth/login', ['error' => 'Username atau password salah.']);
        }
        return view('auth/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
