<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use DateTime;

class BukuEntity extends Entity
{
    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'tahun_terbit' => 'int',
        'kategori_id'  => 'int',
        'genre_id'     => 'int',
        'penulis_id'   => 'int',
        'penerbit_id'  => 'int',
        'diperbarui_oleh' => 'int',
        'created_at'     => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Format judul dengan huruf kapital di awal kata
    public function getJudul(): string
    {
        return ucwords(strtolower($this->attributes['judul'] ?? ''));
    }

    // Format tanggal dibuat
    public function getDibuatPada(string $format = 'd M Y'): string
    {
        $tanggal = $this->attributes['created_at'] ?? null;

        if ($tanggal instanceof DateTime) {
            return $tanggal->format($format);
        }

        if (is_string($tanggal)) {
            return (new DateTime($tanggal))->format($format);
        }

        return '';
    }

    // Format tanggal diperbarui
    public function getDiperbaruiPada(string $format = 'd M Y H:i'): string
    {
        $tanggal = $this->attributes['updated_at'] ?? null;

        if ($tanggal instanceof DateTime) {
            return $tanggal->format($format);
        }

        if (is_string($tanggal)) {
            return (new DateTime($tanggal))->format($format);
        }

        return '';
    }

    // Ambil cuplikan deskripsi terbatas
    public function getDeskripsi(int $limit = 100): string
    {
        $text = strip_tags($this->attributes['deskripsi'] ?? '');
        return strlen($text) > $limit ? substr($text, 0, $limit) . '...' : $text;
    }
    public function getFileSampul(): string
    {
        $file = $this->attributes['file_sampul'] ?? null;
        if (!$file) {
            return ''; // atau URL placeholder
        }

        return base_url('uploads/sampul/' . $file);
    }
}
