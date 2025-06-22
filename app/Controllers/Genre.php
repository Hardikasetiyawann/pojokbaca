<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GenreModel;
use CodeIgniter\API\ResponseTrait;

class Genre extends BaseController
{
    use ResponseTrait;

    protected $genreModel;

    public function __construct()
    {
        $this->genreModel = new GenreModel();
    }

    public function index()
    {
        $data = $this->genreModel->findAll();
        return $this->respond($data);
    }

    public function show($id = null)
    {
        $genre = $this->genreModel->find($id);
        if (!$genre) {
            return $this->failNotFound("Genre dengan ID $id tidak ditemukan.");
        }
        return $this->respond($genre);
    }

   public function create()
    {
        $data = $this->request->getJSON(true);

        if (empty($data)) {
            return $this->fail('Data tidak boleh kosong.', 400);
        }

        if (!$this->genreModel->insert($data)) {
            return $this->failValidationErrors($this->genreModel->errors());
        }

        $newData = $this->genreModel->find($this->genreModel->insertID());

        return $this->respondCreated([
            'status'  => true,
            'message' => 'Genre berhasil ditambahkan.',
            'data'    => $newData
        ]);
    }

    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        if (empty($data)) {
            return $this->fail('Data tidak boleh kosong.', 400);
        }

        if (!$this->genreModel->find($id)) {
            return $this->failNotFound("Genre dengan ID $id tidak ditemukan.");
        }

        if (!$this->genreModel->update($id, $data)) {
            return $this->failValidationErrors($this->genreModel->errors());
        }

        return $this->respond([
            'status'  => true,
            'message' => 'Genre berhasil diperbarui.'
        ]);
    }

    public function delete($id = null)
    {
        if (!$this->genreModel->find($id)) {
            return $this->failNotFound("Genre dengan ID $id tidak ditemukan.");
        }

        $this->genreModel->delete($id);
        return $this->respondDeleted([
            'status' => true,
            'message' => 'Genre berhasil dihapus.'
        ]);
    }
}
