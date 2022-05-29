# Imenik

## Zaganjanje

Postavimo se v mapo htdocs in zaženemo:
```git clone https://github.com/Andrew920/Imenik.git```

S pomočjo PhpMyAdmin importamo __db.sql__ in tako dobimo bazo contacts v kateri bodo shranjeni uporabniki, kontakti in nastavitve.

Nato odpremo brskalnik in se postavimo na naslov:
```http://localhost/[mapa v katero smo klonirali repozitorij]/imenik/code/index.php/```

![image](https://user-images.githubusercontent.com/47641054/170866375-9b1c13b7-5101-41fd-a492-7e0a7d1ff560.png)

## Uporaba

Na strani vidimo javno dostopne kontakte. Določene kontakte je mogoče spreminjati tudi kot anonimen uporabnik (če je lastnik tako nastavil ob kreaciji kontakta).

### Navigacija
+ Z gumbom *__registracija__* se postavimo na stran za registracijo
+ Z gumbom *__prijava__* se lahko prijavimo v aplikacijo
+ Z iskalnim poljem in gumbom *__išči__* lahko iščemo med kontakti
+ z gumbom *__sortiraj__* lahko sortiramo kontakte po imenu, priimku ali starosti

### Uporabniška imena in gesla za testiranje:<br>
    
| Uporabniško ime  | Geslo |
| ------------- | ------------- |
| user  | pass  |
| uporabnik  | geslo  |

Po prijavi lahko tudi dodajamo nove uporabnike, javne ali zasebne, in urejamo obstoječe.
