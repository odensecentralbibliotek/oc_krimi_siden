
jQuery( document ).ready(function() {
    var protocol = location.protocol;
    var slashes = protocol.concat("//");
    var host = slashes.concat(window.location.hostname);
    krimi_app = {}; // create namespace for our app
    krimi_app.defined_data = Backbone.Model.extend({
        defaults: {
        service_url: host,
        get_books_by_author_sparql: '/krimi/get-books-by-author/%#%',
        get_books_by_main_char_sparql: '/krimi/get-books-by-main-char/%#%',
        get_books_by_genre_sparql: '/krimi/get-books-by-genre/%#%',
        get_book_genres_sparql: '/krimi/get-author-genres/%#%',
        get_authors_in_book_genre_sparql: '/krimi/get-authors-in-genre/%#%'
        },
        initialize: function(){
        }
    });
    krimi_app.app_data = new krimi_app.defined_data;
});


