<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PeminjamanModel;
use CodeIgniter\API\ResponseTrait;

class Peminjaman extends BaseController
{
    use ResponseTrait;

    protected $peminjamanModel;

    public function __construct()
    {
        $this->peminjamanModel = new PeminjamanModel();
    }

    // GET /peminjaman
    public function index()
    {
        $data = $this->peminjamanModel->findAll();
        return $this->respond(['data' => $data]);
    }

    // POST /peminjaman
    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$this->peminjamanModel->insert($data)) {
            return $this->failValidationErrors($this->peminjamanModel->errors());
        }

        return $this->respondCreated([
            'status'  => true,
            'message' => 'Peminjaman berhasil ditambahkan.',
            'data'    => $data,
        ]);
    }

    // GET /peminjaman/user/{user_id}
    public function getByUser($user_id)
    {
        $data = $this->peminjamanModel
            ->join('buku', 'buku.id = peminjaman.buku_id')
            ->where('peminjaman.user_id', $user_id)
            ->select('peminjaman.*, buku.judul, buku.file_sampul, buku.isi_buku')
            ->findAll();

        return $this->respond(['data' => $data]);
    }

    // DELETE /peminjaman/{id}
    public function delete($id = null)
    {
        $found = $this->peminjamanModel->find($id);
        if (!$found) {
            return $this->failNotFound("Peminjaman dengan ID $id tidak ditemukan.");
        }

        $this->peminjamanModel->delete($id);

        return $this->respondDeleted([
            'status'  => true,
            'message' => 'Peminjaman berhasil dihapus.',
        ]);
    }
}
