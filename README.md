# Bài tập lập trình website bằng PHP tại VCS

## Cài đặt

### SQL

Chạy file `vcs_web_programming.sql` để tạo lại CSDL

### Run

Chạy trực tiếp bằng lệnh

```
php -S 127.0.0.1:8080
```

Hoặc copy toàn bộ source code vào /var/www/html để chạy trên apache2

```
sudo cp -R ./ /var/www/html
```


### Một số lưu ý

Chức năng liên quan đến upload file sẽ lưu file tại directory `storages` ngay trong thư mục code( thư mục này đã được thêm vào `.gitignore`). Trong CSDL sẽ lưu đường dẫn trực tiếp đến file, trên máy mỗi người sẽ khác nhau, cho nên với dữ liệu có sẵn trong CSDL hiện tại thì mang qua máy khác sẽ không thể tải file được, tuy nhiên up file mới lên vẫn hoạt động bình thường.