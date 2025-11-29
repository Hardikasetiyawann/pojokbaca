<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class AdminEntity extends Entity
{
    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'created_at'     => 'datetime',
        'updated_at' => 'datetime',
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

    // Format tanggal created_at
    public function getDibuatPada(string $format = 'd M Y H:i'): string
    {
        $date = $this->attributes['created_at'] ?? null;

        if ($date instanceof \DateTime) {
            return $date->format($format);
        }

        if (is_string($date)) {
            return (new \DateTime($date))->format($format);
        }

        return '';
    }
}
