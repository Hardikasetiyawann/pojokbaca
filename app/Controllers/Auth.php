<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{
    public function login()
    {
        $data = $this->request->getJSON();
        $username = $data->nama ?? '';
        $password = $data->password ?? '';

        // Coba cari di tabel pengguna
        $penggunaModel = new \App\Models\PenggunaModel();
        $user = $penggunaModel->where('nama', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            return $this->respond([
                'status' => true,
                'data' => [
                    'id'     => $user->id,
                    'nama'   => $user->nama,
                    'email'  => $user->email,
                    'role'   => 'user'
                ],
                'role' => 'user'
            ]);
        }

        // Coba cari di tabel admin
        $adminModel = new \App\Models\AdminModel();
        $admin = $adminModel->where('nama', $username)->first();

        if ($admin && password_verify($password, $admin['password'])) {
            return $this->respond([
                'status' => true,
                'data' => [
                    'id'     => $admin->id,
                    'nama'   => $admin->nama,
                    'email'  => $admin->email,
                    'role'   => 'admin'
                ],
                'role' => 'admin'
            ]);
        }

        return $this->respond([
            'status' => false,
            'message' => 'Login gagal: Nama atau password salah'
        ], 401);
    }
}
