# 🌍 Global Canlı Döviz ve Finans Paneli (JSON API Entegrasyonu)

Bu proje, global piyasalardaki döviz kurlarını harici bir JSON API (ExchangeRate-API) üzerinden çekerek kullanıcıya sunan, modern ve tam uyumlu (responsive) bir finansal dashboard uygulamasıdır.

## 🚀 Öne Çıkan Özellikler

* **JSON API Entegrasyonu:** PHP kullanılarak dış bir RESTful servisten canlı veri çekme ve ayrıştırma (JSON Parsing) işlemleri.
* **Gerçek Zamanlı Borsa Bandı (Ticker):** Ekranın üst kısmında piyasa standartlarına uygun, CSS animasyonlarıyla kurgulanmış kesintisiz kayan finansal veri şeridi.
* **Dinamik Döviz Çevirici:** API'den gelen güncel "Mid-Market" piyasa ortalamalarını baz alarak çalışan algoritmik hesaplama aracı.
* **Modern UI/UX Tasarımı:** Glassmorphism (cam efekti) dokunuşları, yumuşak hover efektleri ve Bootstrap 5 framework'ü ile tasarlanmış profesyonel görünüm.

## 🛠️ Kullanılan Teknolojiler

* **Backend:** PHP (Harici API Tüketimi)
* **Frontend:** HTML5, CSS3, Bootstrap 5
* **Veri Kaynağı:** ExchangeRate-API (Open JSON Endpoint)

## ⚙️ Kurulum ve Çalıştırma

Bu proje herhangi bir veritabanı (MySQL vb.) kurulumu gerektirmez. "Tak-Çalıştır" mantığıyla kurgulanmıştır.

1. Proje dosyalarını bilgisayarınızdaki yerel sunucunun (XAMPP/WAMP) `htdocs` veya `www` dizinine kopyalayın.
2. PHP konfigürasyonunuzda harici linklerden veri çekebilmek için `allow_url_fopen` özelliğinin açık olduğundan emin olun (XAMPP'ta varsayılan olarak açıktır).
3. Tarayıcınızdan `index.php` dosyasını çalıştırarak canlı verileri görüntüleyebilirsiniz.
