<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use CodeIgniter\API\ResponseTrait;

class Kategori extends BaseController
{
    use ResponseTrait;

    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data = $this->kategoriModel->findAll();
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $data = $this->kategoriModel->find($id);
        if (!$data) {
            return $this->failNotFound("Kategori dengan ID $id tidak ditemukan.");
        }
        return $this->respond($data);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (empty($data)) {
            return $this->fail('Data tidak boleh kosong.', 400);
        }

        if (!$this->kategoriModel->insert($data)) {
            return $this->failValidationErrors($this->kategoriModel->errors());
        }

        $data['id'] = $this->kategoriModel->insertID();

        return $this->respondCreated([
            'status' => true,
            'message' => 'Kategori berhasil ditambahkan.',
            'data' => $data
        ]);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (empty($data)) {
            return $this->fail('Data tidak boleh kosong.', 400);
        }

        if (!$this->kategoriModel->find($id)) {
            return $this->failNotFound("Kategori dengan ID $id tidak ditemukan.");
        }

        if (!$this->kategoriModel->update($id, $data)) {
            return $this->failValidationErrors($this->kategoriModel->errors());
        }

        return $this->respond([
            'status' => true,
            'message' => 'Kategori berhasil diperbarui.'
        ]);
    }

    public function delete($id = null)
    {
        if (!$this->kategoriModel->find($id)) {
            return $this->failNotFound("Kategori dengan ID $id tidak ditemukan.");
        }

        $this->kategoriModel->delete($id);
        return $this->respondDeleted([
            'status' => true,
            'message' => 'Kategori berhasil dihapus.'
        ]);
    }
}
