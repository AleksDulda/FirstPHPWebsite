# FirstPHPWebsite
Bursa Technical University Introduction Film Review Website With PHP.


### Websitenin Amacı
> Bu website bir film değerlendirme sitesidir. Herhangi bir spesifik film için kullanılabilir. Bu örnekte BTÜ tanıtım filmi örnek olarak kullanılmıştır.

### Link
- Websitesine ulaşmak için: http://95.130.171.20/~st21360859025/index.php
- Website Tanıtım Videosu: https://www.youtube.com/watch?v=6WTjLSqeBX8

### Kullanım
- Websitesine girildiğinde en başta bizi anasayfa karşılamakta ve anasayfada değerlendirme yapan kullanıcıların değerlendirmeleri gözükmekte.
- Değerlendirme Yapabilmek için:
1. İlk başta kayıt olmak gerekir. Kayıt olduktan sonra anasayfaya yönlendirilir.
2. Ardından giriş yap tuşuna basılır ve kullanıcı adı ve şifreyle giriş yapılır.
3. Navigasyon barından değerlendir kısmından istenilen bilgiler girildikten sonra değerlendirme tuşuna basılarak değerlendirme bitirilir.
4. Değerlendirme görüntüle kısmında kullanıcının yaptığı değerlendirmeler listelenilebilir, düzenlenebilir ve hatta silinebilir.

### XAMPP ile nasıl kullanılır?
- xampp'ı çalıştırdıktan sonra php myadmin kısmına kendiniz bir databası oluşturun. (örn: film_db)
- dbstorage21360859025.sql dosyasında yazan kodları oluşturduğunuz database sql kod yazma yerine yapıştırıp çalıştırın. Bu sayede gerekli tablolar oluşmuş olacak.
- Repoda olan .php uzantılı dosyları ve aynı dizine videoyu da htdocs klasörüne koyun ve database bağlanma kısımlarına 
 > $mysqli = mysqli_connect("localhost", "root", "", "film_db"); gibi değişiklikleri yaparsanız (varsa özelleştirdiğiniz username ve şifre girmeniz gerekir) kendi localinizde bu websitesini kullanabileceksiniz
-
