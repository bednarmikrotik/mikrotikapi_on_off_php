# mikrotikapi_on_off_php

Konfiguracja Mikrotika do współpracy z kodem PHP.

Logujemy się do Mikrotika i wykonujemy następujące kroki.

1. Włączamy service i dajemy dostęp tylko z określonego IP
   
   /ip service
   set api address=192.168.1.100/32

2. Dodajemy użytkownika
   
   /system/users/
   
   Name: user_git
   
   Grup: FULL
   
   Allowed Address: 192.168.1.100/32
   
   Password: P@$$w0rd

4. Dodajemy do Firewalla reguły
   
   /ip/firewall/filter/
   
   add action=drop chain=forward comment=TV disabled=yes out-interface-list=WAN src-address=192.168.1.97
   
   add action=drop chain=forward comment=Tablet disabled=yes out-interface-list=WAN src-address=192.168.1.90

   add action=drop chain=forward comment=Telefon disabled=yes out-interface-list=WAN src-address=192.168.1.90

Konfiguracja skryptów PHP.

1. Kopiujemy pliki repo na serwer WWW z obsługą PHP.

2. W pliku index.php i stan.php poprawiamy
   
   $API->connect('192.168.1.1', 'user_git', 'P@$$w0rd')

   Podając IP routera, login i ustawione hasło

