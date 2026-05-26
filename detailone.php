<?php 
include 'koneksione.php'; 

// Ambil ID dari URL
$id = isset($_GET['id']) ? mysqli_real_escape_string($connone, $_GET['id']) : 0;

// Query data destinasi
$query_dest = mysqli_query($connone, "SELECT * FROM destinasi WHERE id_destinasi = '$id'");
$data = mysqli_fetch_assoc($query_dest);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='index.php';</script>";
    exit;
}

// Cek apakah ini halaman Flores
$isFlores = (stripos($data['nama_destinasi'], 'Flores') !== false);

// Cek apakah ini halaman Trenggalek
$isTrenggalek = (stripos($data['nama_destinasi'], 'Trenggalek') !== false);

// Cek apakah ini halaman Bali
$isBali = (stripos($data['nama_destinasi'], 'Bali') !== false);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail - <?php echo $data['nama_destinasi']; ?></title>
    <!-- Google Fonts untuk kesan Estetik -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-blue: #70d1ff;
            --dark-blue: #005fa3;
            --light-bg: #e0f7ff;
            --accent-orange: #ff8c00;
        }

        body { 
            font-family: 'Poppins', sans-serif; 
            background: url('URL_GAMBAR_LATAR_BELAKANG_KAMU') no-repeat center center fixed;
            background-size: cover;
            background-color: var(--light-bg);
            margin: 0; 
            color: #444; 
            line-height: 1.6;
        }

        .container { 
            max-width: 850px; 
            margin: 50px auto; 
            background: rgba(255, 255, 255, 0.92); 
            backdrop-filter: blur(10px);
            padding: 50px; 
            border-radius: 30px; 
            box-shadow: 0 20px 50px rgba(0,0,0,0.1); 
        }
        
        .header-title { text-align: center; margin-bottom: 40px; }
        .header-title h1 { 
            font-family: 'Playfair Display', serif;
            margin: 0; 
            color: #001524; 
            font-size: 42px; 
            text-transform: capitalize; 
            letter-spacing: 1px;
        }
        .header-title .location { 
            font-size: 18px; 
            margin-top: 8px; 
            color: var(--dark-blue); 
            font-weight: 300;
        }

        .facility-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
        }
        .facility-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: white;
            padding: 10px 15px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            min-width: 80px;
        }
        .facility-item i {
            font-size: 24px;
            color: var(--dark-blue);
            margin-bottom: 5px;
        }
        .facility-item span {
            font-size: 11px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
        }
        .meal-info {
            font-size: 10px !important;
            color: #ff8c00 !important;
            margin-top: 2px;
        }

        .terlaris-badge {
            background: linear-gradient(135deg, #ff4757, #ff6b81);
            color: white;
            padding: 6px 20px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin-top: 15px;
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.3);
            animation: pulse 2s infinite;
            text-transform: uppercase;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .back-btn { 
            text-decoration: none; 
            color: var(--dark-blue); 
            font-weight: 500; 
            display: inline-flex; 
            align-items: center;
            margin-bottom: 25px; 
            transition: 0.3s;
            font-size: 14px;
        }
        .back-btn:hover { color: var(--primary-blue); transform: translateX(-5px); }

        .price-section { 
            text-align: center; 
            margin: 30px 0; 
            padding: 25px; 
            border-radius: 20px; 
            background: linear-gradient(145deg, #ffffff, #f0faff);
            border: 1px solid rgba(112, 209, 255, 0.3);
        }
        .old-price { text-decoration: line-through; color: #a0a0a0; font-size: 18px; }
        .new-price { 
            color: #2d3436; 
            font-size: 36px; 
            font-weight: 600; 
            display: block; 
            margin-top: 5px; 
            font-family: 'Poppins', sans-serif;
        }
        .promo-tag { 
            background: var(--accent-orange); 
            color: white; 
            padding: 4px 14px; 
            border-radius: 50px; 
            font-size: 13px; 
            vertical-align: middle;
            margin-left: 10px;
        }

        .itinerary { 
            background: rgba(112, 209, 255, 0.05); 
            padding: 30px; 
            border-radius: 20px; 
            border-left: 5px solid var(--primary-blue);
            margin: 40px 0; 
        }
        .itinerary h3 { 
            font-family: 'Playfair Display', serif;
            margin-top: 0; 
            color: #001524; 
            font-size: 24px;
        }
        .itinerary ul { list-style: none; padding: 0; }
        .itinerary li { 
            margin-bottom: 15px; 
            padding-left: 30px; 
            position: relative; 
            font-size: 15px;
            font-weight: 300;
        }
        .itinerary li::before { 
            content: "✦"; 
            position: absolute; 
            left: 0; 
            color: var(--primary-blue); 
        }

        .gallery-title { 
            text-align: center; 
            font-family: 'Playfair Display', serif;
            font-size: 22px; 
            margin: 50px 0 20px 0; 
            color: #001524; 
        }
        .gallery-title::after { 
            content: ''; 
            display: block; 
            width: 40px; 
            height: 2px; 
            background: var(--primary-blue); 
            margin: 10px auto; 
        }
        .photo-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 12px; }
        .photo-grid img { 
            width: 100%; height: 150px; object-fit: cover; border-radius: 15px; 
            cursor: pointer; transition: 0.5s; 
        }
        .photo-grid img:hover { transform: translateY(-10px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }

        #lightbox {
            display: none; position: fixed; z-index: 9999; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.85); justify-content: center; align-items: center; backdrop-filter: blur(5px);
        }
        #lightbox img { max-width: 85%; max-height: 80%; border-radius: 15px; }
        
        .close-lightbox {
            position: absolute; top: 30px; right: 40px; color: white; font-size: 40px;
            cursor: pointer; transition: 0.3s;
        }
        .btn-booking { 
            display: block; text-align: center; 
            background: linear-gradient(135deg, #25d366, #128c7e); 
            color: white; padding: 22px; 
            text-decoration: none; border-radius: 20px; 
            margin: 60px auto 20px auto; 
            font-weight: 600; font-size: 18px; 
            width: 80%; transition: 0.4s;
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.2);
            letter-spacing: 1px;
        }
    </style>
</head>
<body>

<div id="lightbox" onclick="this.style.display='none'">
    <span class="close-lightbox">&times;</span>
    <img id="lightbox-img" src="" alt="Zoomed Image">
</div>

<div class="container">
    <a href="index.php" class="back-btn">← Back to Explore</a>
    
    <div class="header-title">
        <h1><?php echo $data['nama_destinasi']; ?></h1>
        
        <?php if($isFlores || $isBali): ?>
            <div class="terlaris-badge">TERLARIS 🔥</div>
        <?php endif; ?>

        <div class="location">📍 <?php echo $data['lokasi']; ?></div>

        <!-- FASILITAS -->
        <div class="facility-container">
            <?php if($isFlores): ?>
                <div class="facility-item"><i class="fas fa-hotel"></i><span>Hotel</span></div>
                <div class="facility-item"><i class="fas fa-bus"></i><span>Transport</span></div>
                <div class="facility-item"><i class="fas fa-utensils"></i><span>Meals</span><span class="meal-info">Incl. in Hotel</span></div>
                <div class="facility-item"><i class="fas fa-map-marked-alt"></i><span>Tour Guide</span></div>
            <?php elseif($isTrenggalek): ?>
                <div class="facility-item"><i class="fas fa-ship"></i><span>Transport</span></div>
                <div class="facility-item"><i class="fas fa-hotel"></i><span>Hotel</span></div>
                <div class="facility-item"><i class="fas fa-utensils"></i><span>Makan</span></div>
                <div class="facility-item"><i class="fas fa-map-marked-alt"></i><span>Tour Guide</span></div>
            <?php elseif($isBali): ?>
                <div class="facility-item"><i class="fas fa-hotel"></i><span>Hotel</span></div>
                <div class="facility-item"><i class="fas fa-bus"></i><span>Bus + Kapal</span></div>
                <div class="facility-item"><i class="fas fa-utensils"></i><span>Makan</span></div>
                <div class="facility-item"><i class="fas fa-map-marked-alt"></i><span>Tour Guide</span></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- HARGA -->
    <div class="price-section">
        <?php if($isFlores): ?>
            <span class="old-price">Harga Normal: Rp 20.500.000</span>
            <span class="new-price">Rp 18.000.000 <span class="promo-tag">Diskon 12%</span></span>
        <?php elseif($isTrenggalek): ?>
            <span class="old-price">Harga Normal: Rp 7.954.545</span>
            <span class="new-price">Rp 7.000.000 <span class="promo-tag">Diskon 12%</span></span>
        <?php elseif($isBali): ?>
            <span class="old-price">Harga Asli: Rp 11.363.636</span>
            <span class="new-price">Rp 10.000.000 <span class="promo-tag">Diskon 12%</span></span>
        <?php else: ?>
            <span class="new-price">Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></span>
        <?php endif; ?>
    </div>

    <!-- ITINERARY BALI -->
    <?php if($isBali): ?>
    <div class="itinerary">
        <h3>Rencana Perjalanan (Itinerary) 🌴✈️:</h3>
        <ul>
            <li><strong>Hari 1–3:</strong> Perjalanan Batam → Bali (Darat + Kapal via Sumatra & Jawa). Makan & Istirahat (Include).</li>
            <li><strong>Hari 4:</strong> Check-in Hotel (Kuta/Seminyak), Santai di Pantai Kuta & Sunset.</li>
            <li><strong>Hari 5:</strong> Ubud Tour: Tegalalang Rice Terrace, Monkey Forest, Pasar Seni & Coffee View.</li>
            <li><strong>Hari 6:</strong> Wisata Tanah Lot Temple (Iconic Sunset View Bali).</li>
            <li><strong>Hari 7:</strong> Uluwatu Temple, Tari Kecak saat Sunset & Pantai Padang Padang.</li>
            <li><strong>Hari 8:</strong> Nusa Penida Tour: Kelingking Beach, Broken Beach, Angel’s Billabong & Snorkeling.</li>
            <li><strong>Hari 9:</strong> Free Day: Santai di Canggu/Seminyak, Beach Club & Belanja Oleh-oleh.</li>
            <li><strong>Hari 10:</strong> Check-out Hotel & Perjalanan pulang bus + kapal ke Batam.</li>
        </ul>
    </div>
    <?php endif; ?>

    <!-- ITINERARY TRENGGALEK -->
    <?php if($isTrenggalek): ?>
    <div class="itinerary">
        <h3>Rencana Perjalanan (Itinerary) ✈️:</h3>
        <ul>
            <li><strong>1. Batam → Jawa (pesawat):</strong> Batam → Surabaya (⏱️ ± 1 jam 10 menit)</li>
            <li><strong>2. Surabaya → Trenggalek (bus):</strong> (⏱️ ± 5-6 jam)</li>
            <li><strong>3. Trenggalek → Pantai Prigi:</strong> Jarak: ± 48 km, Waktu: ± 1,5 jam</li>
            <li><strong>Wisata:</strong> hari pertama ke hotel</li>
            <li><strong>Wisata:</strong> hari kedua ke pantai mutiara dan pondokprigi </li>
            <li><strong>Wisata:</strong> hari ketiga ke pantai prigi dan PPN </li>
            <li><strong>Wisata:</strong> hari kedua ke jembatan magrove </li>
            <li><strong>4. Jawa → Batam:</strong> ⏱️ ± 7 jam</li>
        </ul>
    </div>
    <?php endif; ?>

    <!-- ITINERARY FLORES -->
    <?php if($isFlores): ?>
    <div class="itinerary">
        <h3>Rencana Perjalanan (Itinerary):</h3>
        <ul>
            <li><strong>Hari 1–5:</strong> Perjalanan seru via darat & laut (Bus + Kapal).</li>
            <li><strong>Hari 5–7:</strong> Labuan Bajo - Menginap di Hotel & Explore keindahan kota.</li>
            <li><strong>Hari 7–8:</strong> Wae Rebo - Trekking ke desa adat & Homestay Mbaru Niang.</li>
            <li><strong>Hari 8:</strong> Kembali ke Labuan Bajo (Istirahat Hotel).</li>
            <li><strong>Hari 9:</strong> Island Hopping - Keliling pulau & snorkeling (Kembali ke Hotel).</li>
            <li><strong>Hari 10–15:</strong> Perjalanan pulang yang berkesan.</li>
        </ul>
    </div>
    <?php endif; ?>

    <!-- GALLERY SECTION -->
    <div class="gallery-section">
        
        <?php if($isBali): ?>
            <div class="gallery-title">Hari 4: Pantai Kuta (Sunset)</div>
            <div class="photo-grid">
                <img src="kuta1.jpg" onclick="openImg(this.src)">
                <img src="kuta2.jpg" onclick="openImg(this.src)">
                <img src="kuta3.jpg" onclick="openImg(this.src)">
                <img src="kuta4.jpg" onclick="openImg(this.src)">
            </div>

            <div class="gallery-title">Hari 5: Ubud (Rice Terrace, Monkey Forest & Coffee)</div>
            <div class="photo-grid">
                <img src="tegalalang.jpg" onclick="openImg(this.src)">
                <img src="monkey_forest.jpg" onclick="openImg(this.src)">
                <img src="pasar_ubud.jpg" onclick="openImg(this.src)">
                <img src="coffee_view.jpg" onclick="openImg(this.src)">
            </div>

            <div class="gallery-title">Hari 6 & 7: Tanah Lot, Uluwatu & Kecak</div>
            <div class="photo-grid">
                <img src="tanah_lot.jpg" onclick="openImg(this.src)">
                <img src="uluwatu.jpg" onclick="openImg(this.src)">
                <img src="kecak_dance.jpg" onclick="openImg(this.src)">
                <img src="padang_padang.jpg" onclick="openImg(this.src)">
            </div>

            <div class="gallery-title">Hari 8: Nusa Penida Tour</div>
            <div class="photo-grid">
                <img src="kelingking.jpg" onclick="openImg(this.src)">
                <img src="broken_beach.jpg" onclick="openImg(this.src)">
                <img src="angels_billabong.jpg" onclick="openImg(this.src)">
                <img src="snorkeling.jpg" onclick="openImg(this.src)">
            </div>

            <div class="gallery-title">Hari 9: Canggu, Beach Club & Shopping</div>
            <div class="photo-grid">
                <img src="canggu.jpg" onclick="openImg(this.src)">
                <img src="beach_club.jpg" onclick="openImg(this.src)">
                <img src="oleholeh1.jpg" onclick="openImg(this.src)">
                <img src="oleholeh2.jpg" onclick="openImg(this.src)">
            </div>
        <?php endif; ?>

        <?php if($isFlores): ?>
            <div class="gallery-title">Labuan Bajo & Hotel</div>
            <div class="photo-grid">
                <img src="bajo1.jpg" onclick="openImg(this.src)">
                <img src="bajo2.jpg" onclick="openImg(this.src)">
                <img src="bajo3.jpg" onclick="openImg(this.src)">
                <img src="bajo4.jpg" onclick="openImg(this.src)">
            </div>
            <div class="photo-grid">
                <img src="hotel1.jpg" onclick="openImg(this.src)">
                <img src="hotel2.jpg" onclick="openImg(this.src)">
                <img src="hotel3.jpg" onclick="openImg(this.src)">
                <img src="hotel4.jpg" onclick="openImg(this.src)">
            </div>
            <div class="gallery-title">Wae Rebo & Homestay Adat</div>
            <div class="photo-grid">
                <img src="waerebo1.jpg" onclick="openImg(this.src)">
                <img src="waerebo2.jpg" onclick="openImg(this.src)">
                <img src="waerebo3.jpg" onclick="openImg(this.src)">
                <img src="waerebo4.jpg" onclick="openImg(this.src)">
            </div>
            <div class="photo-grid">
                <img src="home1.jpg" onclick="openImg(this.src)">
                <img src="home2.jpg" onclick="openImg(this.src)">
                <img src="home3.jpg" onclick="openImg(this.src)">
                <img src="home4.jpg" onclick="openImg(this.src)">
            </div>
            <div class="gallery-title">Mules Island (Hotel & Wisata)</div>
            <div class="photo-grid">
                <img src="mules_h1.jpg" onclick="openImg(this.src)">
                <img src="mules_h2.jpg" onclick="openImg(this.src)">
                <img src="mules_h3.jpg" onclick="openImg(this.src)">
                <img src="mules_h4.jpg" onclick="openImg(this.src)">
            </div>
            <div class="photo-grid">
                <img src="mules_w1.jpg" onclick="openImg(this.src)">
                <img src="mules_w2.jpg" onclick="openImg(this.src)">
                <img src="mules_w3.jpg" onclick="openImg(this.src)">
                <img src="mules_w4.jpg" onclick="openImg(this.src)">
            </div>
        <?php endif; ?>

        <?php if($isTrenggalek): ?>
            <div class="gallery-title">Pantai Mutiara & Pondok Prigi</div>
            <div class="photo-grid">
                <img src="mutiara1.jpg" onclick="openImg(this.src)">
                <img src="mutiara2.jpg" onclick="openImg(this.src)">
                <img src="mutiara3.jpg" onclick="openImg(this.src)">
                <img src="mutiara4.jpg" onclick="openImg(this.src)">
            </div>
            <div class="photo-grid">
                <img src="pondok1.jpg" onclick="openImg(this.src)">
                <img src="pondok2.jpg" onclick="openImg(this.src)">
                <img src="pondok3.jpg" onclick="openImg(this.src)">
                <img src="pondok4.jpg" onclick="openImg(this.src)">
            </div>
            <div class="gallery-title">Pantai Prigi & PPN</div>
            <div class="photo-grid">
                <img src="prigi1.jpg" onclick="openImg(this.src)">
                <img src="prigi2.jpg" onclick="openImg(this.src)">
                <img src="prigi3.jpg" onclick="openImg(this.src)">
                <img src="prigi4.jpg" onclick="openImg(this.src)">
            </div>
            <div class="photo-grid">
                <img src="ppn1.jpg" onclick="openImg(this.src)">
                <img src="ppn2.jpg" onclick="openImg(this.src)">
                <img src="ppn3.jpg" onclick="openImg(this.src)">
                <img src="ppn4.jpg" onclick="openImg(this.src)">
            </div>
            <div class="gallery-title">Jembatan Mangrove & Hotel Prigi</div>
            <div class="photo-grid">
                <img src="mangrove1.jpg" onclick="openImg(this.src)">
                <img src="mangrove2.jpg" onclick="openImg(this.src)">
                <img src="mangrove3.jpg" onclick="openImg(this.src)">
                <img src="mangrove4.jpg" onclick="openImg(this.src)">
            </div>
            <div class="photo-grid">
                <img src="hprigi1.jpg" onclick="openImg(this.src)">
                <img src="hprigi2.jpg" onclick="openImg(this.src)">
                <img src="hprigi3.jpg" onclick="openImg(this.src)">
                <img src="hprigi4.jpg" onclick="openImg(this.src)">
            </div>
        <?php endif; ?>
    </div>

    <?php 
        $link_wa = "https://wa.me/6282244302393?text=Halo%20Dream%20Escape,%20saya%20tertarik%20dengan%20paket%20wisata%20" . urlencode($data['nama_destinasi']);
    ?>
    <a href="<?php echo $link_wa; ?>" target="_blank" class="btn-booking">BOOKING NOW VIA WHATSAPP</a>
</div>

<script>
    function openImg(src) {
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox').style.display = 'flex';
    }
</script>

</body>
</html>