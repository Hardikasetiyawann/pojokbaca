<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use CodeIgniter\API\ResponseTrait;

class Buku extends BaseController
{
    use ResponseTrait;

    protected $bukuModel;

    public function __construct()
    {
        $this->bukuModel = new BukuModel();
    }

    public function index()
    {
        $data = $this->bukuModel->findAll();
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $buku = $this->bukuModel->find($id);
        if (!$buku) {
            return $this->failNotFound("Buku dengan ID $id tidak ditemukan");
        }
        return $this->respond($buku);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);
        if (empty($data)) {
            return $this->fail('Data tidak boleh kosong', 400);
        }

        if (!$this->bukuModel->insert($data)) {
            return $this->failValidationErrors($this->bukuModel->errors());
        }

        $data['id'] = $this->bukuModel->insertID();

        return $this->respondCreated([
            'status'  => true,
            'message' => 'Buku berhasil ditambahkan',
            'data'    => $data
        ]);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);
        if (empty($data)) {
            return $this->fail('Data tidak boleh kosong', 400);
        }

        if (!$this->bukuModel->find($id)) {
            return $this->failNotFound("Buku dengan ID $id tidak ditemukan");
        }

        if (!$this->bukuModel->update($id, $data)) {
            return $this->failValidationErrors($this->bukuModel->errors());
        }

        return $this->respond([
            'status'  => true,
            'message' => 'Data buku berhasil diperbarui'
        ]);
    }

    public function delete($id = null)
    {
        if (!$this->bukuModel->find($id)) {
            return $this->failNotFound("Buku dengan ID $id tidak ditemukan");
        }

        $this->bukuModel->delete($id);

        return $this->respondDeleted([
            'status'  => true,
            'message' => 'Data buku berhasil dihapus'
        ]);
    }
}
