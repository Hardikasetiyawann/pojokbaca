<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Entities\Pengguna;

class Penggunaa extends ResourceController
{
    protected $modelName = 'App\Models\PenggunaModel';
    protected $format    = 'json';

    public function index()
    {
        $pengguna = $this->model->findAll();

        return $this->respond([
            'status' => true,
            'message' => 'Daftar pengguna',
            'data' => $pengguna
        ]);
    }

    public function show($id = null)
    {
        $pengguna = $this->model->find($id);

        if (!$pengguna) {
            return $this->failNotFound('Pengguna tidak ditemukan');
        }

        return $this->respond([
            'status' => true,
            'message' => 'Detail pengguna',
            'data' => $pengguna
        ]);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->fail('Data tidak boleh kosong', 400);
        }

        if (!$this->validateData($data, $this->model->getValidationRules(), $this->model->getValidationMessages())) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $pengguna = new Pengguna($data);

        // Gunakan setter entity jika tersedia, contoh:
        if (isset($data['kata_sandi'])) {
            $pengguna->kata_sandi = $data['kata_sandi'];
        }

        if (!$this->model->save($pengguna)) {
            return $this->failServerError($this->model->errors());
        }

        $pengguna->id = $this->model->getInsertID();

        return $this->respondCreated([
            'status' => true,
            'message' => 'Pengguna berhasil didaftarkan',
            'data' => $pengguna
        ]);
    }

    public function update($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Pengguna tidak ditemukan');
        }

        $data = $this->request->getJSON(true);
        $data['id'] = $id;

        if (!$this->validateData($data, $this->model->getValidationRules(), $this->model->getValidationMessages())) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $pengguna = new Pengguna($data);

        if (isset($data['kata_sandi'])) {
            $pengguna->kata_sandi = $data['kata_sandi'];
        }

        if (!$this->model->save($pengguna)) {
            return $this->failServerError($this->model->errors());
        }

        return $this->respondUpdated([
            'status' => true,
            'message' => 'Data pengguna berhasil diperbarui',
            'data' => $pengguna
        ]);
    }

    public function delete($id = null)
    {
        if (!$this->model->find($id)) {
            return $this->failNotFound('Pengguna tidak ditemukan');
        }

        if (!$this->model->delete($id)) {
            return $this->failServerError('Gagal menghapus pengguna');
        }

        return $this->respondDeleted([
            'status' => true,
            'message' => 'Pengguna berhasil dihapus',
            'id' => $id
        ]);
    }
}
