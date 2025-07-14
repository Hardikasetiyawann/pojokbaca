<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\API\ResponseTrait;

class Admin extends BaseController
{
    use ResponseTrait;

    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        $data = $this->adminModel->findAll();
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $data = $this->adminModel->find($id);
        if (!$data) {
            return $this->failNotFound("Admin dengan ID $id tidak ditemukan");
        }
        return $this->respond($data);
    }

    public function create()
    {
        $input = $this->request->getJSON(true);
        if (empty($input)) {
            return $this->fail('Input tidak boleh kosong.', 400);
        }

    
        if (isset($input['password'])) {
            $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
        }

        if (!$this->adminModel->insert($input)) {
            return $this->failValidationErrors($this->adminModel->errors());
        }

        $input['id'] = $this->adminModel->getInsertID();
        unset($input['password']); // jangan kirim password ke response

        return $this->respondCreated([
            'status'  => true,
            'message' => 'Data admin berhasil ditambahkan',
            'data'    => $input,
        ]);
    }


    public function update($id = null)
    {
        $input = $this->request->getJSON(true);
        if (empty($input)) {
            return $this->fail('Input tidak boleh kosong.', 400);
        }

        if (!$this->adminModel->find($id)) {
            return $this->failNotFound("Admin dengan ID $id tidak ditemukan");
        }

        if (!$this->adminModel->update($id, $input)) {
            return $this->failValidationErrors($this->adminModel->errors());
        }

        return $this->respond([
            'status'  => true,
            'message' => 'Data admin berhasil diperbarui',
        ]);
    }

    public function delete($id = null)
    {
        if (!$this->adminModel->find($id)) {
            return $this->failNotFound("Admin dengan ID $id tidak ditemukan");
        }

        $this->adminModel->delete($id);

        return $this->respondDeleted([
            'status'  => true,
            'message' => 'Data admin berhasil dihapus',
        ]);
    }
    // Admin.php (Controller)
    public function login()
    {
        $json = $this->request->getJSON();
        $username = $json->username ?? '';
        $password = $json->password ?? '';

        $admin = $this->adminModel->where('username', $username)->first();

        if ($admin && password_verify($password, $admin['password'])) {
            unset($admin['password']); // amankan password dari response

            return $this->respond([
                'status' => true,
                'message' => 'Login berhasil',
                'role' => 'admin',
                'data' => $admin
            ]);
        } else {
            return $this->respond([
                'status' => false,
                'message' => 'Login gagal: username atau password salah'
            ], 401);
        }
    }


}
