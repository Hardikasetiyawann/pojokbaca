<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PenggunaEntity extends Entity
{
    /**
     * Tanggal-tanggal penting yang perlu diformat sebagai objek DateTime
     */
    protected $dates = [
        'tanggal_lahir',
        'terakhir_login',
        'dibuat_pada',
        'diperbarui_pada',
    ];

    /**
     * Konversi otomatis tipe data untuk properti tertentu
     */
    protected $casts = [
        'email_terverifikasi' => 'boolean',
        'status_akun'         => 'integer',
    ];

    /**
     * Nilai default untuk field tertentu
     */
    protected $attributes = [
        'role'        => 'user',  // Default peran
        'status_akun' => 1,       // 1 = aktif, 0 = nonaktif
    ];

    /**
     * Pemetaan nama input ke nama kolom database
     */
    protected $datamap = [
        // Contoh: 'namaDepan' => 'nama_depan',
    ];

    /**
     * Izinkan mass assignment untuk semua properti
     */
    protected $allowFill = true;

    /**
     * Setter untuk password yang otomatis meng-hash sebelum disimpan
     */
    public function setPassword(string $password): self
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }

    /**
     * Getter untuk nama, diformat dengan huruf kapital di setiap kata
     */
    public function getNama(): string
    {
        return ucwords(strtolower($this->attributes['nama'] ?? ''));
    }

    /**
     * Getter untuk tanggal lahir, bisa diformat ke berbagai format
     *
     * @param string $format Format tanggal (default: d M Y)
     * @return string
     */
    public function getTanggalLahir(string $format = 'd M Y'): string
    {
        $tgl = $this->attributes['tanggal_lahir'] ?? null;

        if ($tgl instanceof \DateTimeInterface) {
            return $tgl->format($format);
        }

        if (is_string($tgl)) {
            try {
                return (new \DateTime($tgl))->format($format);
            } catch (\Exception $e) {
                return '';
            }
        }

        return '';
    }
}
