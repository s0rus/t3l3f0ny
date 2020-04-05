# t3l3f0ny
projekt na bazy 2020

Stwórz prosty projekt umożliwiający ocenianie telefonów zapewniający elementarne funkcjonalności
związane z bazą danych.

Do strony powinien być dodany prosty szablon: banner, menu. Strona estetyczna, również będzie
oceniana i można za nią otrzymać punkty lub nie.
Strona powinna mieć w menu 7 linków(proste menu): telefony, producenci, modyfikuj, oceń, kontakt
Odpowiednio:

a) telefony – ma wyświetlać wszystkie telefony w tabeli wraz z parametrami w tabelce. Obok
telefonu widnieje zdjęcie, które można dodać w formularzu dodawania. Przy wyświetlaniu powinno
być wyświetlone pole producent, w którym widnieją producenci urządzeń zapisani w bazie. Po
wybraniu danego producenta lista wszystkich urządzeń zawężana jest do danego producenta. Obok
telefonu powinna widnieć ikona do usunięcia telefonu z bazy. Usunięcie telefonu powinno zmniejszać
ilość telefonów danego producenta

b) producenci – ma wyświetlać dodaną listę producentów urządzeń, obok listy powinna pojawić się
ikona, która pozwala na usunięcie producenta z bazy.

c) dodaj - mają być udostępnione dwa interfejsy( formularze) do poprawnego dodawania telefonów
oraz producentów do bazy.
Po dodaniu telefonu do bazy powinna zwiększyć się także ilość urządzeń wydanych przez wybranego
producenta
Przy dodawaniu urządzenia dobrze by było aby producenci byli wydobywani z bazy i dało się ich
wybierać z menu rozwijanego lub w jakiś inny sensowny sposób.

d) modyfikuj telefon – powinna być możliwość wyboru telefonu z tabeli oraz w formularzu zmienienie
danych tego telefonu. (Dane w formularzu modyfikacji powinny być wczytywane z bazy – lepiej
punktowane)

f) modyfikuj producenta– powinna być możliwość wyboru producenta z tabeli oraz w formularzu
zmienienie danych tego producenta. (Dane w formularzu modyfikacji powinny być wczytywane z
bazy – lepiej punktowane)

g) oceń – wyświetla zdjęcie wraz z parametrami telefonu oraz ilością ocen pozytywnych,
negatywnych, średnią ocen oraz ikonami + oraz -. Kliknięcie ‘+’ dodaje ocenę pozytywną a kliknięcie
‘-‘ ocenę negatywną.

h) kontakt – ten link powinien prowadzić do strony, która wyświetla informacje o projekcie i autorze.

Programowanie w PHP powinno być zapisane w stylu obiektowym.

Baza danych jeżeli nie istnieje, powinna być utworzona automatycznie.

Pola w bazie powinny przechowywać podstawowe informacje jak poniżej. (Można dodać własne
dodatkowe kolumny na dane jeśli istnieje taka potrzeba)
producent – nazwa producenta Xiaomi
siedziba – miasto głównej siedziny producenta np. HonkKong
ilosc_urzadzen – ilość urządzeń wypuszczona na rynek np. 5

nazwa – nazwa telefonu np. Mi10
rok_wydania- rok wydania np. 2020
rozdzielczosc - rozdzielczość aparatu głównego w MP(MegaPikselach) np. 48
ilosc_aparatow- Ilość aparatów np. 2
taktowanie_procesora - Taktowanie procesora np. 2,0
Ilość-rdzeni-Ilość rdzeni np. 4
Pamiec_ram-Ilość pamięci RAM w GB np. 128
Pamieci_rom-Ilość pamięci ROM w GB np. 6
Uwagi – Rdzenie mają różną częstotliwość taktowania. 2 rdzenie mają częstotliwość 2GHz a 2
pozostałe 1,6 GHz

Przykład.
Dodajemy producentów xiaomi, sony, Samsung
Dodajemy telefony Mi9, Mi10, Xperia Ultra, S10+, S20. Czyli 2 telefony xiaomi, 1 sony oraz 2 samsungi
Usuwamy z listy telefon mi9 to w polu ilosc_urzadzen dla producenta xiaomi widnieje 1. W bazie
sumarycznie zostają 4 telefony.

Cele
- konstruowanie własnej bazy
- nabieranie wprawy w konstruowaniu zapytań i ich wykonywaniu

- powtórka materiału z lekcji
- radzenie sobie z problemami z PHP i MySQL
- współpraca z innymi przedmiotami – szata graficzna
- wyrabianie motywacji
- organizacja czasu pracy

Ocenianie
Ocenie podlegać będą następujące rzeczy. Przewiduję 2 oceny. Pierwsza to postęp prac zgodnie z
etapami opisanymi poniżej a druga całościowa za projekt.
- wygląd
- łatwość w obsłudze
- zapewnienie funkcjonalności opisanej w wymaganiach
- błędy i problemy z działaniem
- postęp prac z projektem

Etapy
Projekt dzielimy na 6 etapów. Co tydzień będziecie dokumentowali to co udało się Wam zrobić.
Sposób w jaki to robić i gdzie przesyłać będę Wam co tydzień przesyłał przez dziennik.
1. Przygotowanie bazy danych
2. Wyświetlanie danych
3. Dodawanie danych
4. Modyfikacja danych
5. Ocenianie telefonów
6. Szata graficzna i ostateczne poprawki
