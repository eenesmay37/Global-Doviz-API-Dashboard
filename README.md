# 🌍 Global Canlı Döviz ve Finans Paneli (JSON API Entegrasyonu)

<img width="1886" height="892" alt="dövizzzzzzzz" src="https://github.com/user-attachments/assets/aa616e20-fe97-4e34-afc6-c61e2789f431" />

Bu proje, global piyasalardaki döviz kurlarını harici bir JSON API (ExchangeRate-API) üzerinden çekerek kullanıcıya sunan, modern ve tam uyumlu (responsive) bir finansal dashboard uygulamasıdır.

# 🌍 Global Finans Paneli PRO (Live API & Trend Dashboard)

Bu proje, global piyasalardaki döviz kurlarını harici bir JSON API üzerinden çekerek kullanıcıya sunan; trend analizi, çoklu dil desteği (i18n) ve akıllı alarm sistemleri ile donatılmış profesyonel bir finansal yönetim panelidir.

## 🚀 Öne Çıkan Özellikler

* **📊 Dinamik Trend Analizi (Chart.js):** Güncel veriler üzerinden kurgulanan algoritmik dalgalanma simülasyonu ile 7 günlük kur trendini çizen interaktif borsa grafiği.
* **🌐 Çoklu Dil Mimarisi (i18n):** PHP Session ve Associative Array (İlişkisel Dizi) mantığı kullanılarak kurgulanmış, anlık Türkçe (TR) ve İngilizce (EN) dil geçiş desteği.
* **🚨 Akıllı Kur Alarm Sistemi:** Kullanıcının belirlediği hedef kur eşiği aşıldığında sistemi tetikleyen ve bildirim veren Session tabanlı otomasyon.
* **💱 Canlı JSON API Entegrasyonu:** ExchangeRate-API üzerinden anlık piyasa ortalamalarını (Mid-Market) çekip parse etme işlemi.
* **🎨 Glassmorphism UI (Modern Tasarım):** Bootstrap 5 ve özel CSS dokunuşlarıyla tasarlanmış, cam efekti (blur) ve karanlık tema (Dark Mode) odaklı profesyonel arayüz.

## 🛠️ Kullanılan Teknolojiler

* **Backend:** PHP (Harici API Tüketimi, Session Yönetimi, Algoritmik Veri Üretimi)
* **Frontend:** HTML5, CSS3, Bootstrap 5, JavaScript
* **Veri Görselleştirme:** Chart.js
* **Veri Kaynağı:** ExchangeRate-API (Open JSON Endpoint)

## ⚙️ Kurulum ve Çalıştırma

Veritabanı kurulumu gerektirmez. "Tak-Çalıştır" mantığıyla kurgulanmıştır.

1. Proje dosyalarını yerel sunucunuzun (XAMPP/WAMP) `htdocs` veya `www` dizinine kopyalayın.
2. Tarayıcınızdan `index.php` dosyasını çalıştırarak sisteme giriş yapın.
3. Panel üzerinden dil değiştirebilir, güncel kurlarla hesaplama yapabilir ve alarm kurabilirsiniz.
