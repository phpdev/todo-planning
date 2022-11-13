# To-Do Planning

PHP 8.1 ve Symfony 5.4 LTS ile geliştirildi. Veritabanı olarak MySQL 8 kullanıldı.  
Arayüz için Webpack Encore, Symfony UX ve VueJS kullanıldı.

### Kurulum
- Aşağıdaki komutlar çalıştırılmalı.
- Kurulum bittikten sonra `https://localhost/` adresi ziyaret edilebilir.
```bash
docker compose build --pull --no-cache
docker compose up
```

---

NOT: Kurulum sırasında aşağıdaki işlemler otomatik olarak yapılır.
- Composer ile php bağımlılıklarının kurulumu
- Mysql veritabanı oluşturulması
- Migration'ların çalıştırılması
- Fixtures ile örnek developer'ların veritabanına kaydedilmesi
- Command ile provider'lardan verilerin çekilmesi
- Yarn ile frontend bağımlılıklarının kurulumu ve build