<?php
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');

// 1. GLOBAL JSON API ENTEGRASYONU (ExchangeRate-API)
$api_url = "https://open.er-api.com/v6/latest/TRY";
$json_veri = file_get_contents($api_url);
$data = json_decode($json_veri, true); // JSON veriyi PHP dizisine çeviriyoruz

$tum_dovizler = [];
$onemli_kurlar = [];

// Popüler kurların isimlerini görsel güzellik için biz tanımlıyoruz
$kur_isimleri = [
    'USD' => 'Amerikan Doları', 'EUR' => 'Euro', 'GBP' => 'İngiliz Sterlini',
    'JPY' => 'Japon Yeni', 'CHF' => 'İsviçre Frangı', 'CAD' => 'Kanada Doları',
    'AUD' => 'Avustralya Doları', 'CNY' => 'Çin Yuanı', 'AED' => 'B.A.E. Dirhemi',
    'SAR' => 'Suudi Riyali', 'AZN' => 'Azerbaycan Manatı', 'RUB' => 'Rus Rublesi'
];

if ($data && $data['result'] === 'success') {
    foreach ($data['rates'] as $kod => $oran) {
        if ($kod === 'TRY') continue; // Kendimizi listelemeye gerek yok
        
        // API 1 TL'nin yabancı karşılığını veriyor, biz 1 Yabancı paranın TL karşılığını buluyoruz
        $tl_karsiligi = 1 / $oran;
        
        $tum_dovizler[$kod] = [
            'isim' => isset($kur_isimleri[$kod]) ? $kur_isimleri[$kod] : "Yabancı Para ($kod)",
            'deger' => $tl_karsiligi
        ];

        // Vitrine koyacağımız ana kurlar
        if (in_array($kod, ['USD', 'EUR', 'GBP'])) {
            $onemli_kurlar[$kod] = $tum_dovizler[$kod];
        }
    }
} else {
    $hata = "Global API servisine şu an ulaşılamıyor.";
}

// Çevirici Hesaplama
$hesap_sonucu = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hesapla'])) {
    $miktar = (float)$_POST['miktar'];
    $secilen_doviz = $_POST['doviz_kodu'];
    
    if (isset($tum_dovizler[$secilen_doviz]) && $miktar > 0) {
        $hesap_sonucu = $miktar * $tum_dovizler[$secilen_doviz]['deger'];
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Finans Ekranı | Live JSON API</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* Borsa Kayan Yazı */
        .ticker-wrap { width: 100%; overflow: hidden; background-color: #0f172a; color: #38bdf8; padding: 12px 0; border-bottom: 3px solid #38bdf8; }
        .ticker { display: inline-block; white-space: nowrap; padding-right: 100%; animation: ticker 120s linear infinite; }
        .ticker:hover { animation-play-state: paused; cursor: pointer; }
        .ticker-item { display: inline-block; padding: 0 25px; font-weight: 600; font-size: 1.1rem; border-right: 1px solid #334155; }
        @keyframes ticker { 0% { transform: translate3d(0, 0, 0); } 100% { transform: translate3d(-100%, 0, 0); } }

        /* Kart Efektleri */
        .kur-karti { transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); border: none; border-radius: 16px; background: #fff; }
        .kur-karti:hover { transform: translateY(-10px); box-shadow: 0 14px 28px rgba(0,0,0,0.1); }
        .bayrak-yuvarlak { width: 60px; height: 60px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 15px auto; }
        
        /* Çevirici Alanı */
        .cevirici-kutu { background: linear-gradient(135deg, #334155 0%, #0f172a 100%); color: white; border-radius: 16px; box-shadow: 0 10px 20px rgba(15, 23, 42, 0.2); }
    </style>
</head>
<body>

<?php if(!isset($hata)): ?>
<div class="ticker-wrap">
    <div class="ticker">
        <?php foreach ($tum_dovizler as $kod => $veri): ?>
            <div class="ticker-item">
                <?php echo $kod; ?>: ₺<?php echo number_format($veri['deger'], 4, ',', '.'); ?> 
                <span class="text-white ms-1">●</span>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<div class="container mt-5 mb-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark">Global Live Finans Paneli</h2>
        <p class="text-muted">JSON API ile Gerçek Zamanlı Piyasa Kurları</p>
    </div>

    <?php if(isset($hata)): ?>
        <div class="alert alert-danger text-center shadow-sm"><?php echo $hata; ?></div>
    <?php else: ?>
        
        <div class="row mb-5">
            <?php 
            $ikonlar = ['USD' => '🇺🇸', 'EUR' => '🇪🇺', 'GBP' => '🇬🇧'];
            foreach($onemli_kurlar as $kod => $veri): 
            ?>
            <div class="col-md-4 mb-4">
                <div class="card kur-karti shadow-sm p-4 text-center h-100">
                    <div class="bayrak-yuvarlak"><?php echo $ikonlar[$kod]; ?></div>
                    <h4 class="fw-bold text-dark mb-0"><?php echo $kod; ?> / TRY</h4>
                    <p class="text-muted small mb-4"><?php echo $veri['isim']; ?></p>
                    
                    <div class="mt-auto">
                        <span class="d-block text-muted small text-uppercase fw-bold mb-1">Güncel Piyasa Değeri</span>
                        <span class="fs-3 fw-bold text-primary">₺<?php echo number_format($veri['deger'], 4, ',', '.'); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="row">
            <div class="col-lg-5 mb-4">
                <div class="card cevirici-kutu p-4 h-100 border-0">
                    <div class="card-body">
                        <h4 class="fw-bold mb-4 text-info">💱 Hızlı Çevirici</h4>
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label class="form-label small text-white-50">Miktar</label>
                                <input type="number" step="0.01" class="form-control form-control-lg border-0 shadow-sm" name="miktar" required value="<?php echo isset($_POST['miktar']) ? $_POST['miktar'] : '100'; ?>">
                            </div>
                            <div class="mb-4">
                                <label class="form-label small text-white-50">Para Birimi</label>
                                <select class="form-select form-select-lg border-0 shadow-sm" name="doviz_kodu" required>
                                    <?php foreach($tum_dovizler as $kod => $veri): ?>
                                        <option value="<?php echo $kod; ?>" <?php echo (isset($_POST['doviz_kodu']) && $_POST['doviz_kodu'] == $kod) ? 'selected' : ''; ?>>
                                            <?php echo $kod; ?> - <?php echo $veri['isim']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" name="hesapla" class="btn btn-info btn-lg w-100 fw-bold text-dark shadow-sm">Hesapla</button>
                        </form>

                        <?php if($hesap_sonucu !== null): ?>
                            <div class="mt-4 p-3 bg-white bg-opacity-10 rounded-3 text-center border border-secondary">
                                <span class="d-block small text-white-50">Karşılık Değer</span>
                                <h3 class="fw-bold text-white mb-0">₺<?php echo number_format($hesap_sonucu, 2, ',', '.'); ?></h3>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 mb-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0">
                        <h5 class="fw-bold text-dark">Tüm Çapraz Kurlar (JSON)</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light sticky-top">
                                    <tr>
                                        <th class="ps-4">Para Birimi</th>
                                        <th class="text-end pe-4">Güncel Değer (TRY)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($tum_dovizler as $kod => $veri): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <strong class="text-primary"><?php echo $kod; ?></strong><br>
                                            <small class="text-muted"><?php echo $veri['isim']; ?></small>
                                        </td>
                                        <td class="fw-bold text-end pe-4 fs-5">₺<?php echo number_format($veri['deger'], 4, ',', '.'); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>