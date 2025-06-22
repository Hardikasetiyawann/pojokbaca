<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PenilaianBukuEntity extends Entity
{
    protected $dates = ['dibuat_pada', 'diperbarui_pada'];

    protected $casts = [
        'penilaian'   => 'float',
        'buku_id'     => 'integer',
        'pengguna_id' => 'integer',
    ];

    protected $attributes = [
        'penilaian' => 0,
    ];

    public function getPenilaian(string $format = null)
    {
        $nilai = $this->attributes['penilaian'] ?? 0;

        return $format
            ? number_format($nilai, (int) explode('.', $format)[1] ?? 1)
            : $nilai;
    }

    protected function formatTanggal($tanggal, string $format): string
    {
        if ($tanggal instanceof \DateTimeInterface) {
            return $tanggal->format($format);
        }

        if (is_string($tanggal)) {
            return date($format, strtotime($tanggal));
        }

        return '';
    }

    public function getDibuatPada(string $format = 'd M Y H:i')
    {
        return $this->formatTanggal($this->attributes['dibuat_pada'] ?? null, $format);
    }

    public function getDiperbaruiPada(string $format = 'd M Y H:i')
    {
        return $this->formatTanggal($this->attributes['diperbarui_pada'] ?? null, $format);
    }

    public function getCuplikanKomentar(): string
    {
        $komentar = $this->attributes['komentar'] ?? '';
        return strlen($komentar) > 50 ? substr($komentar, 0, 50) . '...' : $komentar;
    }

    public function setKomentar(string $komentar)
    {
        $this->attributes['komentar'] = strip_tags($komentar);
        return $this;
    }
}
