# prusbank
Aplikacja bankowa obsługująca przelewy między kontami, pożyczki oraz spłaty pożyczek. Aplikacja ma także możliwość autoryzacji przelewów na innych stronach. Pracownik może dodatkowo spłacić użytkownikowi pożyczkę oraz odpowiadać na wiadomości od użytkowników. Admin posiada to samo co pracownik oraz może zarządzać użytkownikami. Obsługą tego zajmuje się plik /prusbank/api.php

Strona działa na zasadzie sesji PHP. Dostępne opcje na stronie są wyświetlane zależnie od tego do jakiej grupy należy użytkownik.
Należy utworzyć baze danych 'bank' oraz zaimportować plik bank.sql.
Metoda szyfrowania haseł SHA256

Loginy i hasła
admin:123456
pracownik:123456
user:123456

W pliku prusbank/php/server.php należy wpisać login, hasło oraz adres serwera bazy danych
