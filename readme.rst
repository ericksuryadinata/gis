=============================================
Sistem Informasi Geografis dengan CodeIgniter
=============================================

=========
Instalasi
=========

Windows
-------

MANUAL
``````
Download repository ini, dan pindahkan ke ``$PATH/to/htdocs/`` kalian

lakukan ``composer update`` pada root direktori folder ini

contoh::

 $PATH/to/htdocs/CI-GIS/ > composer update
 #akan muncul list composer yang terupdate
 $PATH/to/htdocs/CI-GIS/ >

ganti ``.env.example`` ke ``.env``, kemudian masukkan konfigurasi sesuai dengan konfigurasi PC/Laptop kalian

contoh::

 DB_PASSWORD=secret_password
 DB_USERNAME=root
 DB_NAME=db_gis
 GMAPS_API_KEY=ini_api_dari_google

kekurangan dari metode manual ini adalah kalian harus sering cek jika ada update terbaru

OTOMATIS
````````
Pastikan `GIT <https://git-scm.com/>`__ telah terinstall di PC/Laptop kalian

Arahkan lokasi ke ``$PATH/to/htdocs/``, kemudian lakukan git clone repository ini

contoh::

 $PATH/to/htdocs/ > git clone https://gitlab.com/ericksuryadinata/CI-GIS.git

setelah itu lakukan hal sama (composer update dan ganti .env.example) seperti cara manual di atas

untuk mendapatkan update terbaru lakukan ``git pull``

Linux / Mac
-----

MANUAL
``````
Hampir sama dengan windows, cuma saja $PATH nya menuju ke ``/var/www/html/`` atau sesuaikan dengan folder ``public_html`` kalian

lakukan ``composer update`` pada root direktori folder ini

contoh::

 /var/www/html/CI-GIS/ > composer update
 #akan muncul list composer yang terupdate
 /var/www/html/CI-GIS/ >

ganti ``.env.example`` ke ``.env``, kemudian masukkan konfigurasi sesuai dengan konfigurasi PC/Laptop kalian

contoh::

 DB_PASSWORD=secret_password
 DB_USERNAME=root
 DB_NAME=db_gis
 GMAPS_API_KEY=ini_api_dari_google

OTOMATIS
````````
Lakukan hal sama dengan cara otomatis di Windows

ENJOY THE TRIP !!