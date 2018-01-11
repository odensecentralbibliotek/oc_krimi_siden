
jQuery( document ).ready(function() {
    krimi_app = {}; // create namespace for our app
    krimi_app.defined_data = Backbone.Model.extend({
        defaults: {
        current_author: '',
        selectionHistory: '',
        service_url: 'http://lod.fynbib.dk:3030/krimisiden/sparql?query=',
        get_books_by_author_sparql: 'PREFIX schema: <http://schema.org/> CONSTRUCT WHERE { ?author schema:author "%#%" . ?author ?o ?p }&output=json',
        get_books_by_main_char_sparql: 'PREFIX schema: <http://schema.org/> CONSTRUCT WHERE { ?mainchar schema:mainCharacter "%#%" . ?mainchar ?o ?p }&output=json',
        get_books_by_genre_sparql: 'PREFIX schema: <http://schema.org/> CONSTRUCT WHERE { ?genre schema:genre <%#%> .?genre ?o ?p}&output=json',
        get_book_genres_sparql: 'PREFIX schema: <http://schema.org/> SELECT distinct ?identifier ?label ?genre_billede WHERE {  ?s schema:author "%#%" .  ?s schema:genre ?identifier .  ?identifier schema:name ?label .  BIND(CONCAT("https://www.odensebib.dk/sites/www.odensebib.dk/files/", ?label, ".jpg") AS ?genre_billede) .}',
        get_authors_in_book_genre_sparql: 'PREFIX schema: <http://schema.org/> select distinct ?author {  ?s schema:productID "faust:%#%" .  ?s schema:genre ?genre .  ?books schema:author ?author .  filter(isLiteral(?author)) }group by ?author order by rand() LIMIT 50'
        },
        initialize: function(){
        }
    });
    krimi_app.app_data = new krimi_app.defined_data;
});


