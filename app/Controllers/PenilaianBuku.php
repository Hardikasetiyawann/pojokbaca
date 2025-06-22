<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenilaianBukuModel;
use CodeIgniter\API\ResponseTrait;

class PenilaianBuku extends BaseController
{
    use ResponseTrait;

    protected $penilaianModel;

    public function __construct()
    {
        $this->penilaianModel = new PenilaianBukuModel();
    }

    public function index()
    {
        $data = $this->penilaianModel->findAll();

        return $this->respond([
            'status' => true,
            'message' => 'Daftar semua penilaian buku',
            'data' => $data
        ]);
    }

    public function show($id = null)
    {
        $data = $this->penilaianModel->find($id);

        if (!$data) {
            return $this->failNotFound("Penilaian buku dengan ID $id tidak ditemukan.");
        }

        return $this->respond([
            'status' => true,
            'message' => 'Detail penilaian buku',
            'data' => $data
        ]);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (empty($data)) {
            return $this->fail('Data tidak boleh kosong.', 400);
        }

        if (!$this->penilaianModel->insert($data)) {
            return $this->failValidationErrors($this->penilaianModel->errors());
        }

        $data['id'] = $this->penilaianModel->insertID();

        return $this->respondCreated([
            'status'  => true,
            'message' => 'Penilaian buku berhasil ditambahkan.',
            'data'    => $data
        ]);
    }

    public function update($id = null)
    {
        if (!$this->penilaianModel->find($id)) {
            return $this->failNotFound("Penilaian buku dengan ID $id tidak ditemukan.");
        }

        $data = $this->request->getJSON(true);

        if (empty($data)) {
            return $this->fail('Data tidak boleh kosong.', 400);
        }

        if (!$this->penilaianModel->update($id, $data)) {
            return $this->failValidationErrors($this->penilaianModel->errors());
        }

        return $this->respond([
            'status'  => true,
            'message' => 'Penilaian buku berhasil diperbarui.'
        ]);
    }

    public function delete($id = null)
    {
        if (!$this->penilaianModel->find($id)) {
            return $this->failNotFound("Penilaian buku dengan ID $id tidak ditemukan.");
        }

        if (!$this->penilaianModel->delete($id)) {
            return $this->failServerError("Gagal menghapus penilaian buku.");
        }

        return $this->respondDeleted([
            'status'  => true,
            'message' => 'Penilaian buku berhasil dihapus.'
        ]);
    }
}
