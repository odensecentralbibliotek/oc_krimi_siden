# LD Krimisiden 
> Enhancing the user experience with Linked Data.

Drupal module for displaying http://www.krimisiden.dk linked data related to ting objects from DBCs datawell.
The module is the UI part of a prototype project which also features a triple store populated with object from http://krimisiden.dk. 

Example: http://test.odensebib.dk/ting/object/870970-basis%3A51292553

## Backend
Apache Jena backend. 
Call to the API is hardcoded in .module.
The OBIB Jena API is not publicly accessible.

## Links

[Jena](https://jena.apache.org/)

## Licensing

MIT

## Known errors

Kendte fejl:

1. Ikke alle krimier er tilgængelige i vores databrønd.
2. Mange krimiers cover billeder er ikke længere tilgængelige via krimisiden.dk
3. Ikke alle krimier findes i krimisidens database og vi kan derfor ikke slå lokation og hovede karakter op.
4. Ikke alle krimi poster i brønden har forfatter tilknytter og vi kan derfor ikke finde lignende forfattere.
5. Mange forfattere er ikke kendt i krimisiden databasen
4. Ikke alle krimi poster i brønden har forfatter tilknyttet og vi kan derfor ikke finde lignende forfattere. ( kan løses delvist med at bruge rdf data , virker kun hvis bogen er kendt i krimisiden)
5. Mange forfattere er ikke kendt i krimisiden databasen
6. Nogle få bøger har ikke "faust:xxx" på sig.
7. Nogle faust numre fra krimisiden rdf peger på andre brønd poster en den valgte krimi.