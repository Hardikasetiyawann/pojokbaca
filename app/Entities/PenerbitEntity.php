<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use DateTime;

class PenerbitEntity extends Entity
{
    protected $dates = ['created_at', 'updated_at'];

    protected $casts = [
        'created_at'     => 'datetime',
        'updated_at' => 'datetime',
        'website'         => 'string',
    ];

    public function getNama(): string
    {
        return ucwords(strtolower($this->attributes['nama'] ?? ''));
    }

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

    public function setWebsite(string $url): void
    {
        $url = preg_replace('#^https?://#', '', $url);
        $this->attributes['website'] = $url;
    }

    public function getWebsite(): ?string
    {
        return $this->attributes['website'] ?? null;
    }
}
