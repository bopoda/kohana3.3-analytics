kohana3.3-analytics
===================

Модуль для работы с google analytics API. Получение количества просмотров страниц.

A module to make integration between your KohanaPHP (v3.x) applications and Google's Analytics API

Use [GAPI](http://code.google.com/p/gapi-google-analytics-php-interface/)

# Configuration

1. Copy analytics config file `config/analytics.php` from module directory to `application/config/analytics.php`
2. Add username, password and report_id data

# Using

1. Get count page views by page uri: `Analytics::instance()->getCountPageViews($pageUri)`
