<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Entities\PenggunaEntity;
use CodeIgniter\HTTP\ResponseInterface;

class Pengguna extends ResourceController
{
    protected $modelName = 'App\Models\PenggunaModel';
    protected $format    = 'json';

    public function index()
    {
        try {
            $pengguna = $this->model->findAll();
            return $this->respond([
                'status'  => true,
                'message' => 'Daftar pengguna',
                'data'    => $pengguna
            ]);
        } catch (\Throwable $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function show($id = null)
    {
        try {
            if (!$id || !is_numeric($id)) {
                return $this->fail('ID tidak valid', 400);
            }

            $pengguna = $this->model->find($id);
            if (!$pengguna) {
                return $this->failNotFound('Pengguna tidak ditemukan');
            }

            return $this->respond([
                'status'  => true,
                'message' => 'Detail pengguna',
                'data'    => $pengguna
            ]);
        } catch (\Throwable $e) {
            return $this->failServerError($e->getMessage());
        }
    }

    public function create()
    {
        try {
            $data = $this->request->getJSON(true);

            if (!$data || !is_array($data)) {
                return $this->fail('Data tidak boleh kosong', 400);
            }

            if (!$this->validateData($data, $this->model->getValidationRules(), $this->model->getValidationMessages())) {
                return $this->failValidationErrors($this->validator->getErrors());
            }

            $pengguna = new PenggunaEntity();
            $pengguna->fill($data);

            if (!empty($data['password'])) {
                $pengguna->password = $data['password'];
            }

            if (!$this->model->save($pengguna)) {
                return $this->failServerError($this->model->errors());
            }

            $pengguna->id = $this->model->getInsertID();

            return $this->respondCreated([
                'status'  => true,
                'message' => 'Pengguna berhasil didaftarkan',
                'data'    => $pengguna
            ]);
        } catch (\Throwable $e) {
            return $this->failServerError('Gagal membuat pengguna: ' . $e->getMessage());
        }
    }

    public function update($id = null)
    {
        try {
            if (!$id || !is_numeric($id)) {
                return $this->fail('ID tidak valid', 400);
            }

            $existing = $this->model->find($id);
            if (!$existing) {
                return $this->failNotFound('Pengguna tidak ditemukan');
            }

            $data = $this->request->getJSON(true);
            if (!$data || !is_array($data)) {
                return $this->fail('Data tidak boleh kosong', 400);
            }

            $data['id'] = $id;

            if (!$this->validateData($data, $this->model->getValidationRules(), $this->model->getValidationMessages())) {
                return $this->failValidationErrors($this->validator->getErrors());
            }

            $pengguna = new PenggunaEntity();
            $pengguna->fill($data);

            if (!empty($data['password'])) {
                $pengguna->password = $data['password'];
            }

            if (!$this->model->save($pengguna)) {
                return $this->failServerError($this->model->errors());
            }

            return $this->respond([
                'status'  => true,
                'message' => 'Data pengguna berhasil diperbarui',
                'data'    => $pengguna
            ],200);
        } catch (\Throwable $e) {
            return $this->failServerError('Gagal memperbarui pengguna: ' . $e->getMessage());
        }
    }

    public function delete($id = null)
    {
        try {
            if (!$id || !is_numeric($id)) {
                return $this->fail('ID tidak valid', 400);
            }

            if (!$this->model->find($id)) {
                return $this->failNotFound('Pengguna tidak ditemukan');
            }

            if (!$this->model->delete($id)) {
                return $this->failServerError('Gagal menghapus pengguna');
            }

            return $this->respondDeleted([
                'status'  => true,
                'message' => 'Pengguna berhasil dihapus',
                'id'      => $id
            ]);
        } catch (\Throwable $e) {
            return $this->failServerError('Gagal menghapus pengguna: ' . $e->getMessage());
        }
    }

    public function login()
    {
        try {
            $json = $this->request->getJSON(true);

            if (!is_array($json) || empty($json['nama']) || empty($json['password'])) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Nama dan password harus diisi'
                ])->setStatusCode(400);
            }

            $user = $this->model->where('nama', $json['nama'])->first();

            if ($user && $user->status_akun == 1 && password_verify($json['password'], $user->password)) {
                return $this->response->setJSON([
                    'status'  => true,
                    'message' => 'Login berhasil',
                    'data'    => [
                        'id'     => $user->id,
                        'nama'   => $user->nama,
                        'email'  => $user->email,
                        'role'   => $user->role,
                        'avatar' => $user->avatar_url,
                        'no_hp'  => $user->no_telepon,
                    ]
                ]);
            }

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Nama atau password salah atau akun belum aktif'
            ])->setStatusCode(401);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Terjadi kesalahan saat login: ' . $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
