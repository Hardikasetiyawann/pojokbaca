<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use DateTime;

class BukuEntity extends Entity
{
    protected $dates = ['dibuat_pada', 'diperbarui_pada'];

    protected $casts = [
        'dibuat_pada'     => 'datetime',
        'diperbarui_pada' => 'datetime',
    ];

    // Format judul dengan huruf kapital di awal kata
    public function getJudul(): string
    {
        return ucwords(strtolower($this->attributes['judul'] ?? ''));
    }

    // Format tanggal dibuat
    public function getDibuatPada(string $format = 'd M Y'): string
    {
        $tanggal = $this->attributes['dibuat_pada'] ?? null;

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
        $tanggal = $this->attributes['diperbarui_pada'] ?? null;

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
}
