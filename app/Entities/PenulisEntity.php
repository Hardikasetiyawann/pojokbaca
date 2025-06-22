<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PenulisEntity extends Entity
{
    protected $dates = ['dibuat_pada', 'diperbarui_pada'];

    protected $casts = [
        'id' => 'integer',
    ];

    protected $attributes = [
        'bio' => '',
    ];

    public function getNamaLengkap(): string
    {
        return ucwords(strtolower($this->attributes['nama'] ?? ''));
    }

    public function getCuplikanBio(): string
    {
        $bio = $this->attributes['bio'] ?? '';
        return strlen($bio) > 50 ? substr($bio, 0, 50) . '...' : $bio;
    }

    public function getDibuatPada(string $format = 'd M Y H:i')
    {
        $value = $this->attributes['dibuat_pada'] ?? null;

        if ($value instanceof \DateTimeInterface) {
            return $value->format($format);
        }

        if (is_string($value)) {
            return date($format, strtotime($value));
        }

        return '';
    }
}
