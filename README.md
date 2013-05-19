kohana3.3-analytics
===================

Модуль для работы с google analytics API.

Основная функция модуля - получение количества просмотров конкретной страницы по её url.

Интеграция приложения на KohanaPHP (v3.3.x) и Google's Analytics API.

О модуле [http://jeka.by/post/1013/modul-analytics-Kohana-3.3-dlya-raboti-s-google-analytics-API](http://jeka.by/post/1013/modul-analytics-Kohana-3.3-dlya-raboti-s-google-analytics-API)

@use [GAPI](http://code.google.com/p/gapi-google-analytics-php-interface/)

# Configuration

1. Copy analytics config file `config/analytics.php` from module directory to `application/config/analytics.php`
2. Add username, password and report_id data

# Using

1. Get count page views by page uri: `Analytics::instance()->getCountPageViews($pageUri)`
