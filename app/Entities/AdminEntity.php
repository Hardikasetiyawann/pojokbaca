<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class AdminEntity extends Entity
{
    protected $dates = ['dibuat_pada', 'diperbarui_pada'];

    protected $casts = [
        'dibuat_pada'     => 'datetime',
        'diperbarui_pada' => 'datetime',
    ];

    // Otomatis hash password
    public function setPassword(string $password)
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    // Format nama dengan huruf kapital awal
    public function getNama(): string
    {
        return isset($this->attributes['nama']) ? ucwords($this->attributes['nama']) : '';
    }

    // Format tanggal dibuat_pada
    public function getDibuatPada(string $format = 'd M Y H:i'): string
    {
        $date = $this->attributes['dibuat_pada'] ?? null;

        if ($date instanceof \DateTime) {
            return $date->format($format);
        }

        if (is_string($date)) {
            return (new \DateTime($date))->format($format);
        }

        return '';
    }
}
