<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PenggunaEntity extends Entity
{
    protected $dates = [
        'tanggal_lahir',
        'terakhir_login',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    protected $casts = [
        'email_terverifikasi' => 'boolean',
    ];

    protected $attributes = [
        'role' => 'user',
        'status_akun' => 'aktif',
    ];

    protected $datamap = [
        // tambahkan pemetaan jika nama field input berbeda dari DB
    ];

    protected $allowFill = true;

    public function setPassword(string $password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    public function getNama(): string
    {
        return ucwords(strtolower($this->attributes['nama'] ?? ''));
    }

    public function getTanggalLahir(string $format = 'd M Y'): string
    {
        $tgl = $this->attributes['tanggal_lahir'] ?? null;
        if ($tgl instanceof \DateTime) {
            return $tgl->format($format);
        }
        if (is_string($tgl)) {
            return (new \DateTime($tgl))->format($format);
        }
        return '';
    }
}
