<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenerbitModel;
use CodeIgniter\API\ResponseTrait;

class Penerbit extends BaseController
{
    use ResponseTrait;

    protected $penerbitModel;

    public function __construct()
    {
        $this->penerbitModel = new PenerbitModel();
    }

    public function index()
    {
        $keyword = $this->request->getGet('search');
        $builder = $this->penerbitModel;

        if ($keyword) {
            $builder->like('nama', $keyword);
        }

        $data = $builder->findAll();

        return $this->respond([
            'status' => true,
            'message' => 'Daftar penerbit',
            'data' => $data
        ]);
    }

    public function show($id = null)
    {
        $data = $this->penerbitModel->find($id);
        if (!$data) {
            return $this->failNotFound("Penerbit dengan ID $id tidak ditemukan.");
        }

        return $this->respond([
            'status' => true,
            'message' => 'Data penerbit ditemukan.',
            'data' => $data
        ]);
    }

    public function create()
    {
        $input = $this->request->getJSON(true);

        if (empty($input)) {
            return $this->fail('Data tidak boleh kosong.', 400);
        }

        if (!$this->penerbitModel->insert($input)) {
            return $this->failValidationErrors($this->penerbitModel->errors());
        }

        $inserted = $this->penerbitModel->find($this->penerbitModel->insertID());

        return $this->respondCreated([
            'status'  => true,
            'message' => 'Penerbit berhasil ditambahkan.',
            'data'    => $inserted
        ]);
    }

    public function update($id = null)
    {
        $input = $this->request->getJSON(true);

        if (empty($input)) {
            return $this->fail('Data tidak boleh kosong.', 400);
        }

        $existing = $this->penerbitModel->find($id);
        if (!$existing) {
            return $this->failNotFound("Penerbit dengan ID $id tidak ditemukan.");
        }

        if (!$this->penerbitModel->update($id, $input)) {
            return $this->failValidationErrors($this->penerbitModel->errors());
        }

        $updated = $this->penerbitModel->find($id);

        return $this->respond([
            'status' => true,
            'message' => 'Penerbit berhasil diperbarui.',
            'data' => $updated
        ]);
    }

    public function delete($id = null)
    {
        $data = $this->penerbitModel->find($id);
        if (!$data) {
            return $this->failNotFound("Penerbit dengan ID $id tidak ditemukan.");
        }

        $this->penerbitModel->delete($id);

        return $this->respondDeleted([
            'status'  => true,
            'message' => 'Penerbit berhasil dihapus.',
        ]);
    }
}
