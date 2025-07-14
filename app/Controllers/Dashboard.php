<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\UserModel;
use App\Models\PeminjamanModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Database\Exceptions\DatabaseException;

class Dashboard extends ResourceController
{
    use ResponseTrait;

    public function getStats()
    {
        try {
            $bukuModel = new BukuModel();
            $userModel = new UserModel();
            $peminjamanModel = new PeminjamanModel();

            // Jumlah total
            $totalBuku = $bukuModel->countAll();
            $totalPengguna = $userModel->countAll();
            $totalDipinjam = $peminjamanModel->where('status', 'dipinjam')->countAllResults();

            // Buku terpopuler (top 5)
            $db = \Config\Database::connect();
            $builder = $db->table('peminjaman');
            $builder->select('buku.judul, COUNT(peminjaman.id) AS jumlah_pinjam');
            $builder->join('buku', 'buku.id = peminjaman.buku_id');
            $builder->groupBy('buku_id');
            $builder->orderBy('jumlah_pinjam', 'DESC');
            $builder->limit(5);
            $topBuku = $builder->get()->getResultArray();

            return $this->respond([
                'success' => true,
                'data' => [
                    'total_buku' => $totalBuku,
                    'total_pengguna' => $totalPengguna,
                    'total_dipinjam' => $totalDipinjam,
                    'top_buku' => $topBuku
                ]
            ]);
        } catch (DatabaseException $e) {
            return $this->failServerError('Terjadi kesalahan pada server: ' . $e->getMessage());
        }
    }
}
