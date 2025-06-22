<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use DateTime;

class PenerbitEntity extends Entity
{
    protected $dates = ['dibuat_pada', 'diperbarui_pada'];

    protected $casts = [
        'dibuat_pada'     => 'datetime',
        'diperbarui_pada' => 'datetime',
        'website'         => 'string',
    ];

    public function getNama(): string
    {
        return ucwords(strtolower($this->attributes['nama'] ?? ''));
    }

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
