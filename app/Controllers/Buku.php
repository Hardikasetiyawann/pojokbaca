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
        $search     = $this->request->getGet('search');
        $genreId    = $this->request->getGet('genre_id');
        $kategoriId = $this->request->getGet('kategori_id');

        $builder = $this->bukuModel;

        if ($search) {
            $builder->like('judul', $search);
        }

        if ($genreId) {
            $builder->where('genre_id', $genreId);
        }

        if ($kategoriId) {
            $builder->where('kategori_id', $kategoriId);
        }

        // Ganti baris ini:
        // $bukuList = $builder->findAll();

        // Dengan baris ini:
        $bukuList = $builder
            ->select('buku.*, genre.nama as genre_nama, kategori.nama as kategori_nama')
            ->join('genre', 'genre.id = buku.genre_id', 'left')
            ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
            ->findAll();

        $data = [];

        foreach ($bukuList as $buku) {
            $bukuArray = is_array($buku) ? $buku : $buku->toArray();

            $file = $bukuArray['file_sampul'] ?? null;
            $path = WRITEPATH . 'uploads/sampul/' . $file;

            $bukuArray['sampul_url'] = ($file && file_exists($path))
                ? base_url('uploads/sampul/' . $file)
                : base_url('images/default-cover.jpg');

            $data[] = $bukuArray;
        }

        return $this->respond(['data' => $data]);
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
        $validationRules = [
            'judul'       => 'required|max_length[255]',
            'genre_id'    => 'required|integer',
            'kategori_id' => 'required|integer',
        ];

        if (!$this->validate($validationRules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = $this->request->getPost();

        // Upload file sampul
        $fileSampul = $this->request->getFile('file_sampul');
        if ($fileSampul && $fileSampul->isValid()) {
            if (!$fileSampul->isImage()) {
                return $this->failValidationErrors(['file_sampul' => 'File sampul harus berupa gambar.']);
            }

            $newName = $fileSampul->getRandomName();
            $fileSampul->move(WRITEPATH . 'uploads/sampul', $newName);
            $data['file_sampul'] = $newName;
        }

        // Upload file PDF isi buku
        $fileIsi = $this->request->getFile('isi_buku');
        if ($fileIsi && $fileIsi->isValid()) {
            if ($fileIsi->getMimeType() !== 'application/pdf') {
                return $this->failValidationErrors(['isi_buku' => 'File isi buku harus berupa PDF.']);
            }

            $newPdfName = $fileIsi->getRandomName();
            $fileIsi->move(WRITEPATH . 'uploads/buku', $newPdfName);
            $data['isi_buku'] = $newPdfName;
        }

        $data['created_at']     = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!$this->bukuModel->insert($data)) {
            return $this->failValidationErrors($this->bukuModel->errors());
        }

        $data['id'] = $this->bukuModel->insertID();

        return $this->respondCreated([
            'status'  => true,
            'message' => 'Buku berhasil ditambahkan.',
            'data'    => $data
        ]);
    }

    public function update($id = null)
    {
        $existing = $this->bukuModel->find($id);
        if (!$existing) {
            return $this->failNotFound("Buku dengan ID $id tidak ditemukan");
        }

        $data = $this->request->getPost();

        // Update file sampul jika ada
        $fileSampul = $this->request->getFile('file_sampul');
        if ($fileSampul && $fileSampul->isValid()) {
            if (!$fileSampul->isImage()) {
                return $this->failValidationErrors(['file_sampul' => 'File sampul harus berupa gambar.']);
            }

            $newName = $fileSampul->getRandomName();
            $fileSampul->move(WRITEPATH . 'uploads/sampul', $newName);
            $data['file_sampul'] = $newName;

            // Hapus file lama
            if (!empty($existing['file_sampul'])) {
                @unlink(WRITEPATH . 'uploads/sampul/' . $existing['file_sampul']);
            }
        }

        // Update file isi buku jika ada
        $fileIsi = $this->request->getFile('isi_buku');
        if ($fileIsi && $fileIsi->isValid()) {
            if ($fileIsi->getMimeType() !== 'application/pdf') {
                return $this->failValidationErrors(['isi_buku' => 'File isi buku harus berupa PDF.']);
            }

            $newPdfName = $fileIsi->getRandomName();
            $fileIsi->move(WRITEPATH . 'uploads/buku', $newPdfName);
            $data['isi_buku'] = $newPdfName;

            // Hapus file lama
            if (!empty($existing['isi_buku'])) {
                @unlink(WRITEPATH . 'uploads/buku/' . $existing['isi_buku']);
            }
        }

        $data['updated_at'] = date('Y-m-d H:i:s');

        if (!$this->bukuModel->update($id, $data)) {
            return $this->failValidationErrors($this->bukuModel->errors());
        }

        return $this->respond([
            'status'  => true,
            'message' => 'Data buku berhasil diperbarui.'
        ]);
    }

    public function delete($id = null)
    {
        $buku = $this->bukuModel->find($id);

        if (!$buku) {
            return $this->failNotFound("Buku dengan ID $id tidak ditemukan");
        }

        // Hapus file jika ada
        if (!empty($buku['file_sampul'])) {
            @unlink(WRITEPATH . 'uploads/sampul/' . $buku['file_sampul']);
        }

        if (!empty($buku['isi_buku'])) {
            @unlink(WRITEPATH . 'uploads/buku/' . $buku['isi_buku']);
        }

        $this->bukuModel->delete($id);

        return $this->respondDeleted([
            'status'  => true,
            'message' => 'Data buku berhasil dihapus.'
        ]);
    }

    public function download($id = null)
    {
        $buku = $this->bukuModel->find($id);

        if (!$buku || empty($buku['isi_buku'])) {
            return $this->failNotFound("File isi buku tidak tersedia");
        }

        $filePath = WRITEPATH . 'uploads/buku/' . $buku['isi_buku'];

        if (!is_file($filePath)) {
            return $this->failNotFound("File tidak ditemukan di server");
        }

        return $this->response->download($filePath, null);
    }

    public function getBooksByUser($userId)
{
    $peminjamanModel = new \App\Models\PeminjamanModel();
    $bukuModel = new \App\Models\BukuModel();

    $peminjaman = $peminjamanModel
        ->where('user_id', $userId)
        ->findAll();
    
    $bookList = [];

    foreach ($peminjaman as $pinjam) {
        $book = $bukuModel->find($pinjam['buku_id']);
        if ($book) {
            $bookList[] = $book;
        }
    }

    return $this->response->setJSON([
        'status' => 200,
        'data' => $bookList
    ]);
}


    public function rekomendasi()
    {
        $model = new \App\Models\BukuModel();
        $recommendedBooks = $model->getRecommendedBooks();
        return $this->respond(['data' => $recommendedBooks]);
    }

    
}
