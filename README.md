# php_test Systém anket

## Úvod
Cílem je vytvořit jednoduchý systém pro tvorbu anketních otázek a možností na ně odpovídat. V sytému bude možné vytvořit několik otázek a pro každou z nich vytvořit několik odpovědí. Pro jednotlivé odpovědi bude možné hlasovat.
Pokyny
Postupujte podle dokumentu. Vytvářejte skripty generující jednoduchý a čistý (bez CSS a formátování) HTML kód. Zbude-li čas, můžete řešit grafickou stránku věci.
U každého úkolu je uveden přibližný čas. Myslím, že je dost nadsazený, takže ho berte spíše jako maximum. Navíc na celou práci budete mít více času než součet všech časů u jednotlivých úkolů.
Výsledek k odevzdání
Odevzdejte:
Skript pro vytvoření databáze, tabulky, uživatele a nastavení přístupových práv
V průběhu řešení screenshot (viz. postup, kde je uvedeno ve kterém okamžiku).
Zip kompletně celého adresáře obsahujícího Vaší aplikaci.

## Postup
### Databáze
Čas: 30m
Vytvořte novou databázi a vhodně ji pojmenujte.
Vytvořte tabulku pro anketní otázky. V tabulce budou atributy id otázky a text otázky. Vhodně pojmenujte tabulku a její atributy.
Vytvořte tabulku pro odpovědi na anketní otázky. U každé odpovědi se bude evidovat id odpovědi, id otázky, ke které odpověď náleží, text odpovědi a počet hlasů.
Vytvořte databázového uživatele, vhodně ho pojmenujte a nastavte mu práva pro čtení a vkládání nových záznamů do tabulek vytvořených v předchozích dvou bodech. U tabulky s odpověďmi navíc povolte i provádění změn (UPDATE).
Formulář pro vložení
Čas: 45 m
Vytvořte formulář pro vkládání anketní otázky. Formulář bude obsahovat jen jedno vstupní pole, což bude víceřádkový text a odesílací tlačítko. Ve stejném skriptu, ve kterém je formulář, zajistěte zpracování dat z formuláře, které bude spočívat ve vložení dat z formuláře do databáze.
Screenshot
Čas: 5m
Zjistěte, zda vkládání otázek funguje. Pokud ano, nyní ODEVZDEJTE SCREENSHOT  z webového prohlížeče, který zobrazí formulář pro vkládání a záznamy v MySQL.
Přehled otázek
Čas: 20m
Do skriptu vytvořeném v předchozím bodě doplňte výpis všech otázek. Výpis zobrazte nad formulářem.
Nápověda: Je nutné, aby vložení otázky bylo před DB dotazem zjišťujícím všechny otázky. Jen tak zajistíte, že se v seznamu zobrazí i právě vložená otázka.
Odkaz na otázku
Čas: 10m
V přehledu všech otázek přidejte k otázce odkaz, na který bude možné kliknout. Odkaz bude směřovat na skript, který v dalším bodu vytvoříte a který bude zobrazovat detail konkrétní otázky. Vymyslete vhodný název pro skript i pro text odkazu v HTML. Za název skriptu v URL přidejte řetězec &id=XX, kde XX je id otázky přečtené z databáze.

### Detail otázky
Čas: 20m
Vytvořte skript jehož jméno a cesta koresponduje s odkazem z předchozího bodu.
Skript zobrazí detail vybrané otázky, který v tomto okamžiku bude pouze text otázky. Zobrazí se jen ta otázka, která má v DB odpovídající id.
Nápověda: Pokud jste v předchozím bodu předali hodnotu parametru id přes URL (tedy URL končí ?id=…), potom ve skriptu, který se na daném URL nachází, budete mít hodnotu k dispozici v asociativním poli _GET pod klíčem, který je shodný s názvem parametru v URL. Tedy v našem případě $_GET[‘id‘].
Aby se nějaká otázka vůbec zobrazila, musí být v URL uvedená nějaká hodnota id.
Nová odpověď
Čas: 45m
Ve skriptu vytvořeném v předchozím bodě vytvořte formulář pro vkládání odpovědi. Formulář bude obsahovat jen jedno vstupní pole, což bude víceřádkový text a odesílací tlačítko. Ve stejném skriptu, ve kterém je formulář, zajistěte zpracování dat z formuláře, které bude spočívat ve vložení dat z formuláře do databáze. Nezapomeňte do tabulky s odpověďmi vložit i id otázky, ke které je odpověď přiřazena.
Přehled odpovědí
Čas: 20m
Do skriptu, který zobrazuje detail otázky vložte mezi text otázky a formulář pro vložení odpovědi seznam všech odpovědí náležících otázce, jejíž detail se zobrazuje.
Pokud máte funkční řešení v tomto stavu, lze ho akceptovat. Máte-li ještě čas, pokračujte dále.


### Přehled všech otázek i s odpověďmi
Čas: 40m
Vytvořte nový skript, kde se zobrazí všechny otázky a pod každou z nich se zobrazí všechny její odpovědi, u každé odpovědi se zobrazí i počet hlasů.
Hlasování
Čas: 30m
Z čísla o počtu hlasů v předchozím bodě udělejte odkaz vedoucí na sebe sama, ale s přidáním parametru id. Proveďte to obdobným způsobem, kterým jste již parametr do URL přidávali.
Například pokud se skript z předchozího bodu jmenuje index.php, povede odkaz na index.php?id=XXX, kde za XXX dosaďte id odpovědi z databáze.
Ve skriptu, nejlépe někde před SQL dotazem pro získání všech otázek, zjistěte, zda byl skript spuštěn s parametrem id, které obsahuje id odpovědi. Pokud ano, navyšte hodnotu atributu počet hlasů v databázi o 1.
Nápověda: SQL příkaz update lze napsat UPDATE …. SET hlasu = hlasu + 1 WHERE ….
Závěr
Uvědomte si, že vytvořená webová aplikace je jen pro předvedení vašich znalostí. Pro praktické použití by musela být administrační část (vytváření otázek a odpovědí), dostupná jen vyvoleným po přihlášení.
Navíc by i nějakým způsobem mělo být znemožněno hlasovat vícekrát.


