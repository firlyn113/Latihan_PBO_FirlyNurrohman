<?php
/**
 * Class TiketVelvet
 * classes/TiketVelvet.php
 * Tahap 4: Implementasi Pewarisan
 */

require_once 'Tiket.php';

class TiketVelvet extends Tiket {
    // Properti tambahan
    private $bantalSelimutPack;
    private $layananButler;
    
    /**
     * Constructor
     */
    public function __construct($data = null) {
        parent::__construct($data);
        if ($data !== null) {
            $this->bantalSelimutPack = $data['bantal_selimut_pack'] ?? 'Bantal+Selimut';
            $this->layananButler = $data['layanan_butler'] ?? 'Butler Service';
        }
    }
    
    // Getter untuk properti tambahan
    public function getBantalSelimutPack() {
        return $this->bantalSelimutPack;
    }
    
    public function getLayananButler() {
        return $this->layananButler;
    }
    
    // Setter untuk properti tambahan
    public function setBantalSelimutPack($bantalSelimutPack) {
        $this->bantalSelimutPack = $bantalSelimutPack;
    }
    
    public function setLayananButler($layananButler) {
        $this->layananButler = $layananButler;
    }
    
    /**
     * Tahap 5: Implementasi Polimorfisme - Overriding
     * Total Harga = (jumlah_kursi * hargaDasarTiket) * 1.50
     */
    public function hitungTotalHarga() {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) * 1.50;
    }
    
    /**
     * Menampilkan info fasilitas Velvet
     */
    public function tampilkanInfoFasilitas() {
        return [
            'bantal_selimut_pack' => $this->bantalSelimutPack,
            'layanan_butler' => $this->layananButler,
            'fasilitas' => [
                'Kursi VIP premium',
                'Paket: ' . $this->bantalSelimutPack,
                'Layanan: ' . $this->layananButler,
                'Layanan antar makanan',
                'Pengalaman mewah'
            ]
        ];
    }
}
?>