<?php
/**
 * Abstract Class Tiket
 * classes/Tiket.php
 * Tahap 3: Implementasi Abstraksi
 */

abstract class Tiket {
    // Properti Terenkapsulasi (protected)
    protected $id_tiket;
    protected $nama_film;
    protected $jadwal_tayang;
    protected $jumlah_kursi;
    protected $hargaDasarTiket;
    
    /**
     * Constructor - Memetakan nilai dari database
     */
    public function __construct($data = null) {
        if ($data !== null) {
            $this->id_tiket = $data['id_tiket'] ?? null;
            $this->nama_film = $data['nama_film'] ?? '';
            $this->jadwal_tayang = $data['jadwal_tayang'] ?? '';
            $this->jumlah_kursi = $data['jumlah_kursi'] ?? 0;
            $this->hargaDasarTiket = $data['harga_dasar_tiket'] ?? 0;
        }
    }
    
    // Getter Methods
    public function getIdTiket() {
        return $this->id_tiket;
    }
    
    public function getNamaFilm() {
        return $this->nama_film;
    }
    
    public function getJadwalTayang() {
        return $this->jadwal_tayang;
    }
    
    public function getJumlahKursi() {
        return $this->jumlah_kursi;
    }
    
    public function getHargaDasarTiket() {
        return $this->hargaDasarTiket;
    }
    
    // Setter Methods
    public function setIdTiket($id_tiket) {
        $this->id_tiket = $id_tiket;
    }
    
    public function setNamaFilm($nama_film) {
        $this->nama_film = $nama_film;
    }
    
    public function setJadwalTayang($jadwal_tayang) {
        $this->jadwal_tayang = $jadwal_tayang;
    }
    
    public function setJumlahKursi($jumlah_kursi) {
        $this->jumlah_kursi = $jumlah_kursi;
    }
    
    public function setHargaDasarTiket($hargaDasarTiket) {
        $this->hargaDasarTiket = $hargaDasarTiket;
    }
    
    /**
     * Method Abstrak (Tanpa Body)
     * Wajib diimplementasikan oleh class anak
     */
    abstract public function hitungTotalHarga();
    abstract public function tampilkanInfoFasilitas();
    
    /**
     * Method untuk menampilkan informasi dasar tiket
     * Mengembalikan array dengan key yang jelas
     */
    public function tampilkanInfoDasar() {
        return [
            'id_tiket' => $this->id_tiket,
            'nama_film' => $this->nama_film,
            'jadwal_tayang' => date('d-m-Y H:i', strtotime($this->jadwal_tayang)),
            'jumlah_kursi' => $this->jumlah_kursi,
            'harga_dasar' => $this->hargaDasarTiket
        ];
    }
}
?>