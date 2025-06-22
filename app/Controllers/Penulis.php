<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenulisModel;
use CodeIgniter\API\ResponseTrait;

class Penulis extends BaseController
{
    use ResponseTrait;

    protected $penulisModel;

    public function __construct()
    {
        $this->penulisModel = new PenulisModel();
    }

    public function index()
    {
        $data = $this->penulisModel->findAll();

        return $this->respond([
            'status'  => true,
            'message' => 'Daftar semua penulis',
            'data'    => $data
        ]);
    }

    public function show($id = null)
    {
        $data = $this->penulisModel->find($id);
        if (!$data) {
            return $this->failNotFound("Penulis dengan ID $id tidak ditemukan.");
        }

        return $this->respond([
            'status'  => true,
            'message' => 'Detail penulis',
            'data'    => $data
        ]);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (empty($data)) {
            return $this->fail('Data tidak boleh kosong.', 400);
        }

        if (!$this->penulisModel->insert($data)) {
            return $this->failValidationErrors($this->penulisModel->errors());
        }

        $data['id'] = $this->penulisModel->insertID();

        return $this->respondCreated([
            'status'  => true,
            'message' => 'Penulis berhasil ditambahkan.',
            'data'    => $data
        ]);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (!$this->penulisModel->find($id)) {
            return $this->failNotFound("Penulis dengan ID $id tidak ditemukan.");
        }

        if (empty($data)) {
            return $this->fail('Data tidak boleh kosong.', 400);
        }

        if (!$this->penulisModel->update($id, $data)) {
            return $this->failValidationErrors($this->penulisModel->errors());
        }

        return $this->respond([
            'status'  => true,
            'message' => 'Penulis berhasil diperbarui.'
        ]);
    }

    public function delete($id = null)
    {
        if (!$this->penulisModel->find($id)) {
            return $this->failNotFound("Penulis dengan ID $id tidak ditemukan.");
        }

        if (!$this->penulisModel->delete($id)) {
            return $this->failServerError("Gagal menghapus penulis.");
        }

        return $this->respondDeleted([
            'status'  => true,
            'message' => 'Penulis berhasil dihapus.'
        ]);
    }
}
