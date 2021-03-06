jQuery(document).ready(function () {
  var protocol = location.protocol;
  var slashes = protocol.concat("//");
  var host = slashes.concat(window.location.hostname + ':' + window.location.port);
  krimi_app = {}; // create namespace for our app
  krimi_app.defined_data = Backbone.Model.extend({
    defaults: {
      service_url: host,
      get_books_by_author_sparql: '/krimi/get-books-by-author/%#%',
      get_books_by_main_char_sparql: '/krimi/get-books-by-main-char/%#%',
      get_books_by_location_sparql: '/krimi/get-books-by-location/%#%',
      get_books_by_genre_sparql: '/krimi/get-books-by-genre/%#%',
      get_book_genres_sparql: '/krimi/get-author-genres/%#%',
      get_authors_in_book_genre_sparql: '/krimi/get-authors-in-genre/%#%',
      get_locations_sparql: '/krimi/get-locations/%#%',
      get_characters_sparql: '/krimi/get-characters/%#%'
    },
    initialize: function () {}
  });
  krimi_app.app_data = new krimi_app.defined_data;
});
