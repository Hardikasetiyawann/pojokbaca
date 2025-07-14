<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PeminjamanEntity extends Entity
{
    protected $datamap = [
        // mapping atribut lain jika nama field DB dan properti berbeda
    ];

    protected $dates   = [
        'created_at',
        'updated_at',
        'deleted_at',
        'tanggal_pinjam',
        'tanggal_kembali',
    ];

    protected $casts   = [
        'id'               => 'integer',
        'user_id'          => 'integer',
        'buku_id'          => 'integer',
        'tanggal_pinjam'   => 'datetime',
        'tanggal_kembali'  => '?datetime',
    ];
}
