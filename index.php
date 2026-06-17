<?php
/**
 * Halaman Utama - Menampilkan Daftar Tiket
 * index.php
 * Tahap 6: Pembuatan Komponen Antarmuka (View)
 */

// Sertakan semua file yang diperlukan
require_once 'koneksi/database.php';
require_once 'classes/Tiket.php';
require_once 'classes/TiketRegular.php';
require_once 'classes/TiketIMAX.php';
require_once 'classes/TiketVelvet.php';

// Fungsi untuk membuat objek tiket berdasarkan jenis studio
function createTiketObject($data) {
    switch ($data['jenis_studio']) {
        case 'Regular':
            return new TiketRegular($data);
        case 'IMAX':
            return new TiketIMAX($data);
        case 'Velvet':
            return new TiketVelvet($data);
        default:
            return new TiketRegular($data);
    }
}

// Fungsi untuk format rupiah
function formatRupiah($amount) {
    return 'Rp ' . number_format($amount, 0, ',', '.');
}

// Ambil data dari database
$conn = getConnection();
$sql = "SELECT * FROM tabel_tiket ORDER BY jenis_studio, id_tiket";
$result = $conn->query($sql);

// Kelompokkan data berdasarkan jenis studio
$tiketGroups = [
    'Regular' => [],
    'IMAX' => [],
    'Velvet' => []
];

if ($result->num_rows > 0) {
    while ($data = $result->fetch_assoc()) {
        $tiket = createTiketObject($data);
        $tiketGroups[$data['jenis_studio']][] = $tiket;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pemesanan Tiket Bioskop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }
        
        .container {
            max-width: 1300px;
            margin: 0 auto;
        }
        
        .header {
            background: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            text-align: center;
        }
        
        .header h1 {
            color: #333;
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .header p {
            color: #666;
            font-size: 1.1em;
        }
        
        .stats {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 15px;
            flex-wrap: wrap;
        }
        
        .stats .stat-item {
            background: #f0f0f0;
            padding: 10px 20px;
            border-radius: 20px;
        }
        
        .stats .stat-item span {
            font-weight: bold;
            color: #764ba2;
        }
        
        .studio-section {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .studio-header {
            display: flex;
            align-items: center;
            gap: 15px;
            border-bottom: 3px solid #eee;
            padding-bottom: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .studio-header h2 {
            font-size: 1.8em;
            color: #333;
        }
        
        .studio-header .badge {
            padding: 5px 15px;
            border-radius: 20px;
            color: white;
            font-weight: bold;
            font-size: 0.9em;
        }
        
        .badge-regular { background: #4CAF50; }
        .badge-imax { background: #2196F3; }
        .badge-velvet { background: #9C27B0; }
        
        .tiket-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
        }
        
        .tiket-card {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            border-left: 5px solid #764ba2;
        }
        
        .tiket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .tiket-card .film-title {
            font-size: 1.3em;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }
        
        .tiket-card .info-row {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            border-bottom: 1px dashed #e0e0e0;
        }
        
        .tiket-card .info-row:last-child {
            border-bottom: none;
        }
        
        .tiket-card .label {
            color: #666;
            font-weight: 500;
        }
        
        .tiket-card .value {
            color: #333;
            font-weight: 600;
        }
        
        .tiket-card .fasilitas {
            background: white;
            padding: 12px;
            border-radius: 8px;
            margin: 10px 0;
            font-size: 0.95em;
        }
        
        .tiket-card .fasilitas ul {
            list-style: none;
            padding: 0;
            margin: 5px 0;
        }
        
        .tiket-card .fasilitas ul li {
            padding: 3px 0;
            padding-left: 20px;
            position: relative;
        }
        
        .tiket-card .fasilitas ul li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #4CAF50;
            font-weight: bold;
        }
        
        .tiket-card .total-harga {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 10px;
        }
        
        .tiket-card .studio-tag {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 15px;
            font-size: 0.75em;
            font-weight: bold;
            color: white;
            margin-bottom: 10px;
        }
        
        .tag-regular { background: #4CAF50; }
        .tag-imax { background: #2196F3; }
        .tag-velvet { background: #9C27B0; }
        
        .empty-message {
            text-align: center;
            padding: 40px;
            color: #999;
            font-size: 1.2em;
        }
        
        @media (max-width: 768px) {
            .header h1 { font-size: 1.8em; }
            .tiket-grid { grid-template-columns: 1fr; }
            .stats { flex-direction: column; gap: 10px; }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>🎬 Sistem Pemesanan Tiket Bioskop</h1>
            <p>Manajemen tiket dengan konsep OOP (Abstraksi, Pewarisan, Polimorfisme)</p>
            <div class="stats">
                <div class="stat-item">
                    Total Tiket: <span><?php echo array_sum(array_map('count', $tiketGroups)); ?></span>
                </div>
                <div class="stat-item">
                    Regular: <span><?php echo count($tiketGroups['Regular']); ?></span>
                </div>
                <div class="stat-item">
                    IMAX: <span><?php echo count($tiketGroups['IMAX']); ?></span>
                </div>
                <div class="stat-item">
                    Velvet: <span><?php echo count($tiketGroups['Velvet']); ?></span>
                </div>
            </div>
        </div>

        <?php
        // Definisikan warna dan ikon untuk setiap studio
        $studioConfig = [
            'Regular' => [
                'icon' => '🎞️',
                'badge_class' => 'badge-regular',
                'tag_class' => 'tag-regular',
                'border_color' => '#4CAF50',
                'desc' => 'Pengalaman menonton standar dengan harga terjangkau'
            ],
            'IMAX' => [
                'icon' => '🎥',
                'badge_class' => 'badge-imax',
                'tag_class' => 'tag-imax',
                'border_color' => '#2196F3',
                'desc' => 'Pengalaman sinematik maksimal dengan teknologi canggih'
            ],
            'Velvet' => [
                'icon' => '✨',
                'badge_class' => 'badge-velvet',
                'tag_class' => 'tag-velvet',
                'border_color' => '#9C27B0',
                'desc' => 'Pengalaman menonton mewah dengan layanan premium'
            ]
        ];

        // Tampilkan tiket per kelompok studio
        foreach ($tiketGroups as $studio => $tikets):
            if (empty($tikets)) continue;
            $config = $studioConfig[$studio];
        ?>
        
        <div class="studio-section">
            <div class="studio-header">
                <h2><?php echo $config['icon']; ?> Studio <?php echo $studio; ?></h2>
                <span class="badge <?php echo $config['badge_class']; ?>">
                    <?php echo count($tikets); ?> Tiket
                </span>
                <span style="color: #666; font-size: 0.9em; margin-left: 10px;">
                    <?php echo $config['desc']; ?>
                </span>
            </div>
            
            <div class="tiket-grid">
                <?php foreach ($tikets as $tiket): 
                    // Ambil informasi dasar
                    $infoDasar = $tiket->tampilkanInfoDasar();
                    // Ambil informasi fasilitas
                    $fasilitas = $tiket->tampilkanInfoFasilitas();
                    // Hitung total harga
                    $totalHarga = $tiket->hitungTotalHarga();
                ?>
                <div class="tiket-card" style="border-left-color: <?php echo $config['border_color']; ?>;">
                    <span class="studio-tag <?php echo $config['tag_class']; ?>">
                        <?php echo $studio; ?>
                    </span>
                    
                    <div class="film-title"><?php echo htmlspecialchars($infoDasar['nama_film'] ?? 'Tidak tersedia'); ?></div>
                    
                    <div class="info-row">
                        <span class="label">🎫 ID Tiket</span>
                        <span class="value">#<?php echo $infoDasar['id_tiket'] ?? '-'; ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="label">📅 Jadwal Tayang</span>
                        <span class="value"><?php echo $infoDasar['jadwal_tayang'] ?? '-'; ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="label">💺 Jumlah Kursi</span>
                        <span class="value"><?php echo $infoDasar['jumlah_kursi'] ?? 0; ?> kursi</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="label">💰 Harga Dasar</span>
                        <span class="value"><?php echo formatRupiah($infoDasar['harga_dasar'] ?? 0); ?></span>
                    </div>
                    
                    <!-- Fasilitas Spesifik -->
                    <div class="fasilitas">
                        <strong>📋 Fasilitas Spesifik:</strong>
                        <ul>
                            <?php 
                            // Pastikan $fasilitas['fasilitas'] adalah array
                            $fasilitasList = isset($fasilitas['fasilitas']) && is_array($fasilitas['fasilitas']) 
                                ? $fasilitas['fasilitas'] 
                                : ['Tidak ada fasilitas tersedia'];
                            ?>
                            <?php foreach ($fasilitasList as $item): ?>
                            <li><?php echo htmlspecialchars($item); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    <!-- Total Harga (Polimorfisme) -->
                    <div class="total-harga">
                        💰 Total Harga: <?php echo formatRupiah($totalHarga); ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <?php endforeach; ?>
        
        <!-- Footer -->
        <div style="text-align: center; color: white; padding: 20px; opacity: 0.8;">
            <p>Dibuat dengan ❤️ menggunakan PHP OOP | 
            Konsep: Abstraksi, Pewarisan, dan Polimorfisme</p>
            <p style="font-size: 0.8em; margin-top: 5px;">
                Total tiket: <?php echo array_sum(array_map('count', $tiketGroups)); ?> data
            </p>
        </div>
    </div>
</body>
</html>