<?php
/**
 * Class TiketRegular
 * classes/TiketRegular.php
 * Tahap 4: Implementasi Pewarisan
 */

require_once 'Tiket.php';

class TiketRegular extends Tiket {
    // Properti tambahan
    private $tipeAudio;
    private $lokasiBaris;
    
    /**
     * Constructor
     */
    public function __construct($data = null) {
        parent::__construct($data);
        if ($data !== null) {
            $this->tipeAudio = $data['tipe_audio'] ?? 'Dolby Digital';
            $this->lokasiBaris = $data['lokasi_baris'] ?? 'Reguler';
        }
    }
    
    // Getter untuk properti tambahan
    public function getTipeAudio() {
        return $this->tipeAudio;
    }
    
    public function getLokasiBaris() {
        return $this->lokasiBaris;
    }
    
    // Setter untuk properti tambahan
    public function setTipeAudio($tipeAudio) {
        $this->tipeAudio = $tipeAudio;
    }
    
    public function setLokasiBaris($lokasiBaris) {
        $this->lokasiBaris = $lokasiBaris;
    }
    
    /**
     * Tahap 5: Implementasi Polimorfisme - Overriding
     * Total Harga = jumlah_kursi * hargaDasarTiket
     */
    public function hitungTotalHarga() {
        return $this->jumlah_kursi * $this->hargaDasarTiket;
    }
    
    /**
     * Menampilkan info fasilitas Regular
     */
    public function tampilkanInfoFasilitas() {
        return [
            'tipe_audio' => $this->tipeAudio,
            'lokasi_baris' => $this->lokasiBaris,
            'fasilitas' => [
                'Layar standar 2D',
                'Audio ' . $this->tipeAudio,
                'Kursi reguler',
                'Harga terjangkau'
            ]
        ];
    }
}
?>