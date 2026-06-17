<?php
/**
 * Class TiketIMAX
 * classes/TiketIMAX.php
 * Tahap 4: Implementasi Pewarisan
 */

require_once 'Tiket.php';

class TiketIMAX extends Tiket {
    // Properti tambahan
    private $kacamata3dId;
    private $efekGerakFitur;
    
    /**
     * Constructor
     */
    public function __construct($data = null) {
        parent::__construct($data);
        if ($data !== null) {
            $this->kacamata3dId = $data['kacamata_3d_id'] ?? 'IMAX-3D-001';
            $this->efekGerakFitur = $data['efek_gerak_fitur'] ?? 'Full Motion';
        }
    }
    
    // Getter untuk properti tambahan
    public function getKacamata3dId() {
        return $this->kacamata3dId;
    }
    
    public function getEfekGerakFitur() {
        return $this->efekGerakFitur;
    }
    
    // Setter untuk properti tambahan
    public function setKacamata3dId($kacamata3dId) {
        $this->kacamata3dId = $kacamata3dId;
    }
    
    public function setEfekGerakFitur($efekGerakFitur) {
        $this->efekGerakFitur = $efekGerakFitur;
    }
    
    /**
     * Tahap 5: Implementasi Polimorfisme - Overriding
     * Total Harga = (jumlah_kursi * hargaDasarTiket) + 35000
     */
    public function hitungTotalHarga() {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) + 35000;
    }
    
    /**
     * Menampilkan info fasilitas IMAX
     */
    public function tampilkanInfoFasilitas() {
        return [
            'kacamata_3d_id' => $this->kacamata3dId,
            'efek_gerak_fitur' => $this->efekGerakFitur,
            'fasilitas' => [
                'Layar raksasa IMAX',
                'Teknologi proyeksi canggih',
                'Audio immersive',
                'Kacamata 3D: ' . $this->kacamata3dId,
                'Fitur efek gerak: ' . $this->efekGerakFitur
            ]
        ];
    }
}
?>