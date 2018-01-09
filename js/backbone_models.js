
jQuery( document ).ready(function() {
    krimi_app = {}; // create namespace for our app
    krimi_app.defined_data = Backbone.Model.extend({
        defaults: {
        current_author: '',
        selectionHistory: '',
        service_url: 'http://lod.fynbib.dk:3030/krim/sparql?query=',
        get_books_by_author_sparql: 'PREFIX schema: <http://schema.org/> CONSTRUCT WHERE { ?author schema:author "%#%" . ?author?o ?p }&output=json',
        get_books_by_isbn_sparql: 'PREFIX schema: <http://schema.org/> CONSTRUCT WHERE { ?isbn schema:isbn "%#%" . ?isbn ?o ?p }&output=json',
        get_books_by_main_char_sparql: 'PREFIX schema: <http://schema.org/> CONSTRUCT WHERE { ?mainchar schema:mainCharacter "%#%" . ?mainchar ?o ?p }&output=json',
        get_books_by_genre_sparql: 'PREFIX schema: <http://schema.org/> CONSTRUCT WHERE { ?genre schema:genre "%#%" . ?genre ?o ?p }&output=json',
        get_book_genres_sparql: 'PREFIX schema: <http://schema.org/> select ?label { ?type a schema:genre; schema:name ?label .}',
        },
        initialize: function(){
             
        }
    });
    krimi_app.app_data = new krimi_app.defined_data;
});


