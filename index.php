<?php include 'koneksione.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dream Escape – Explore in Style</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Dasar & Tipografi */
        body { 
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; 
            margin: 0; padding: 0; 
            scroll-behavior: smooth; 
            background-color: #e0f7ff; 
        }

        /* Navbar Styling */
        nav { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            padding: 15px 60px; 
            background: rgba(255, 255, 255, 0.95); 
            position: fixed; 
            width: 100%; 
            top: 0; 
            z-index: 1000; 
            box-shadow: 0 2px 10px rgba(0, 180, 255, 0.1); 
            box-sizing: border-box; 
        }

        .logo { 
            font-family: 'Brush Script MT', 'Apple Chancery', cursive; 
            font-size: 38px; 
            font-weight: 500; 
            color: #0099cc; 
            letter-spacing: 1px;
        }

        .nav-auth { display: flex; align-items: center; }
        .nav-auth a { 
            text-decoration: none; 
            color: #2c3e50; 
            font-weight: 600; 
            margin-left: 25px; 
            font-size: 14px;
            transition: 0.3s;
        }
        .nav-auth a:hover { color: #00b4ff; }

        /* Hero Section */
        .hero { 
            height: 75vh; 
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('background.Png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center; 
            color: white; 
            text-align: center; 
        }

        .hero h1 { 
            font-family: 'Trebuchet MS', sans-serif;
            font-size: 70px; 
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 4px;
            text-shadow: 2px 4px 15px rgba(0,0,0,0.4);
        }

        .hero p { 
            font-size: 18px; 
            margin-top: 15px;
            font-weight: 300;
            text-transform: lowercase;
            letter-spacing: 5px;
            position: relative;
            display: inline-block;
            padding: 0 15px;
        }

        /* Filter Buttons Styling */
        .filter-container {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 40px;
            margin-bottom: -60px;
        }

        .btn-filter {
            padding: 12px 30px;
            border-radius: 30px;
            border: 2px solid #00b4ff;
            background: white;
            color: #00b4ff;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            font-size: 14px;
        }

        .btn-filter:hover, .btn-filter.active {
            background: #00b4ff;
            color: white;
            box-shadow: 0 4px 15px rgba(0, 180, 255, 0.3);
        }

        /* Grid Destinasi */
        .destination-grid { 
            display: grid; 
            grid-template-columns: repeat(3, 1fr); 
            gap: 35px; 
            padding: 100px 60px 80px 60px; 
        }

        /* Card Style */
        .card { 
            height: 450px; 
            border-radius: 20px; 
            overflow: hidden; 
            box-shadow: 0 10px 25px rgba(0, 150, 200, 0.2); 
            position: relative; 
            transition: 0.4s; 
        }

        .card:hover { transform: translateY(-10px); }
        .card-img { width: 100%; height: 100%; object-fit: cover; transition: 0.5s; }
        .card:hover .card-img { transform: scale(1.1); }

        .card-overlay {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.45); 
            display: flex;
            flex-direction: column;
            justify-content: center; 
            align-items: center;    
            color: white;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .badge { 
            background: #00b4ff; 
            color: white; 
            padding: 6px 14px; 
            position: absolute; 
            top: 15px; 
            left: 15px; 
            border-radius: 8px; 
            font-size: 11px; 
            font-weight: bold;
            z-index: 2;
        }

        .badge-hot { background: #ff4757; left: auto; right: 15px; }
        .badge-hot-left { left: 15px; right: auto; }

        .card h3 { font-size: 30px; margin: 0; text-shadow: 2px 2px 10px rgba(0,0,0,0.7); }
        .stars { color: #ffcc00; font-size: 18px; margin-bottom: 20px; }

        .btn-detail { 
            background: #00b4ff; 
            color: white; 
            padding: 12px 35px; 
            text-decoration: none; 
            border-radius: 50px; 
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
            border: 2px solid #00b4ff;
        }

        .btn-detail:hover { background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(5px); }

        /* Footer Styling */
        footer { background-color: #001524; color: #ffffff; padding: 60px 60px 20px 60px; }
        .footer-container { display: grid; grid-template-columns: 1fr 2fr; gap: 40px; margin-bottom: 40px; }
        .footer-logo .logo-text { font-family: 'Brush Script MT', cursive; font-size: 35px; color: #ffffff; margin-bottom: 10px; }
        .footer-bottom-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; padding: 30px 0; border-top: 1px solid rgba(255,255,255,0.1); }
        
        .social-icons { display: flex; gap: 15px; }
        .social-box { 
            background: rgba(255, 255, 255, 0.1); 
            width: 40px; 
            height: 40px; 
            border-radius: 8px; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            text-decoration: none; 
            color: white;
            font-size: 20px;
            transition: 0.3s; 
        }
        .social-box:hover { background: #E1306C; color: white; }
        
        .whatsapp-link {
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: white;
            transition: 0.3s;
        }
        .whatsapp-link:hover { color: #25D366; }
        .whatsapp-link i { font-size: 24px; }

        .copyright { text-align: center; font-size: 12px; color: #6c757d; margin-top: 20px; }
    </style>
</head>
<body>

<nav>
    <div class="logo">Dream Escape</div>
    <div class="nav-auth">
        <a href="index.php">🏠 Home</a>
        <a href="signinone.php">🔐 Sign In</a>
        <a href="signupone.php">📝 Sign Up</a>
    </div>
</nav>

<section class="hero">
    <h1>Enjoy Your Trip</h1>
    
    <p>----find your best destination----</p>
</section>

<div class="filter-container">
    <?php 
        $filter = isset($_GET['filter']) ? $_GET['filter'] : 'semua'; 
    ?>
    <a href="index.php?filter=semua" class="btn-filter <?php echo $filter == 'semua' ? 'active' : ''; ?>">Semua</a>
    <a href="index.php?filter=terlaris" class="btn-filter <?php echo $filter == 'terlaris' ? 'active' : ''; ?>">Terlaris 🔥</a>
    <a href="index.php?filter=promo" class="btn-filter <?php echo $filter == 'promo' ? 'active' : ''; ?>">Promo ✨</a>
</div>

<div class="destination-grid">
    <?php
    $sql = "SELECT * FROM destinasi";
    
    if ($filter == 'terlaris') {
        $sql .= " WHERE nama_destinasi LIKE '%Bali%' OR nama_destinasi LIKE '%Bintan%' OR nama_destinasi LIKE '%Flores%'";
    } elseif ($filter == 'promo') {
        $sql .= " WHERE kategori LIKE '%Promo%' OR nama_destinasi LIKE '%Trenggalek%' OR nama_destinasi LIKE '%Yogyakarta%' OR nama_destinasi LIKE '%Padang%' OR nama_destinasi LIKE '%Flores%'";
    }
    
    $sql .= " LIMIT 6";
    $query = mysqli_query($connone, $sql);

    while($row = mysqli_fetch_array($query)) {
        $promo_text = $row['kategori'];
        $nama_lc = strtolower($row['nama_destinasi']);
        $gambar_tampil = $row['gambar']; 
        $is_terlaris = false; 
        $terlaris_posisi_kiri = false; 
        $rating = 5; 

        if(strpos($nama_lc, 'bali') !== false) { 
            $gambar_tampil = "bali.jpg"; 
            $is_terlaris = true;
            $terlaris_posisi_kiri = true; 
            $promo_text = ""; 
        }
        elseif(strpos($nama_lc, 'bintan') !== false) { 
            $gambar_tampil = "bintan.jpg"; 
            $is_terlaris = true;
            $terlaris_posisi_kiri = true; 
            $promo_text = ""; 
        }
        elseif(strpos($nama_lc, 'trenggalek') !== false) { 
            $gambar_tampil = "Trenggalek.jpg"; 
            $promo_text = "Promo 12%"; 
        }
        elseif(strpos($nama_lc, 'yogyakarta') !== false) { 
            $gambar_tampil = "yong.jpg"; 
            $promo_text = "Promo 8%"; 
        }
        elseif(strpos($nama_lc, 'flores') !== false) { 
            $gambar_tampil = "flores.jpg"; 
            $is_terlaris = true; 
            $promo_text = "Promo 12%";
        }
        elseif(strpos($nama_lc, 'padang') !== false) { 
            $gambar_tampil = "padang.jpg"; 
            $promo_text = "Promo 15%"; 
        }

        $stars_html = str_repeat('★', $rating);
    ?>
    <div class="card">
        <?php if(!empty($promo_text)): ?>
            <div class="badge"><?php echo $promo_text; ?></div>
        <?php endif; ?>

        <?php if($is_terlaris): ?>
            <div class="badge badge-hot <?php echo ($terlaris_posisi_kiri) ? 'badge-hot-left' : ''; ?>">
                Terlaris 🔥
            </div>
        <?php endif; ?>

        <img src="<?php echo $gambar_tampil; ?>" class="card-img" alt="Destination">
        
        <div class="card-overlay">
            <h3><?php echo $row['nama_destinasi']; ?></h3>
            <p class="lokasi"><?php echo $row['lokasi']; ?></p>
            <div class="stars"><?php echo $stars_html; ?> (<?php echo $rating; ?>.0)</div>
            <a href="detailone.php?id=<?php echo $row['id_destinasi']; ?>" class="btn-detail">Explore Now</a>
        </div>
    </div>
    <?php } ?>
</div>

<footer>
    <div class="footer-container">
        <div class="footer-section footer-logo">
            <div class="logo-text">Dream Escape</div>
            <p>Travel and Tour Agency</p>
        </div>
        <div class="footer-section">
            <h4>About Dream Escape</h4>
            <p>Jelajahi keindahan dunia bersama kami. Paket perjalanan terbaik dengan pelayanan profesional.</p>
        </div>
    </div>
    <div class="footer-bottom-grid">
        <div class="footer-section">
            <p style="color:white; font-weight:bold; margin-bottom:10px;">Email Us</p>
            <p style="margin:0; color:white;">awalya.febriana@gmail.com</p>
        </div>
        <div class="footer-section">
            <p style="color:white; font-weight:bold; margin-bottom:10px;">Follow Us</p>
            <div class="social-icons">
                <a href="https://www.instagram.com/waallya_?" target="_blank" class="social-box">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
        <div class="footer-section">
            <p style="color:white; font-weight:bold; margin-bottom:10px;">Contact Us</p>
            <a href="https://wa.me/6282244302393" target="_blank" class="whatsapp-link">
                <i class="fab fa-whatsapp"></i>
                <span>Chat Admin</span>
            </a>
        </div>
    </div>
    <div class="copyright">Dream Escape © 2026 – Tour & Travel Professional</div>
</footer>

</body>
</html>