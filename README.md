PHPConf Taiwan Website
=============

This repository is the whole source of the website, http://phpconf.tw/ . Hope
you don't mind to remind us when you discovering any bug. ;)

這個專案是 http://phpconf.tw/ 網站的完整原始碼，如果發現問題希望可以告訴我們。

安裝
-----------

下載原始碼
    git clone https://github.com/kiang/phpconf.git phpconf

建立設定檔
    cd phpconf
    cp .htaccess.ex .htaccess
    cp application/application.ini.ex application/application.ini

調整 application/application.ini 的 resources.db.*

匯入資料庫
    mysql -uroot -p phpconf < docs/schema.sql

建立管理者(帳號、密碼都是 kiang ，使用 sha1 雜湊)
    INSERT INTO `administrators` VALUES (NULL, 'kiang', '5107443978246cebf4c9e5785a2c07eada9c11de');

手動輸入管理者登入網址
    http://localhost/phpconf/admin/kiang/login

如果系統沒有 Zend Framework ，請下載後放入 library/Zend