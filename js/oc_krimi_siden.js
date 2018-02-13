/*
 * Setup the backbone js to handle the browsing of linked data
 */
jQuery( document ).ready(function() {
    /*
     * Main Menu view
     */
   krimi_app.MainView = Backbone.View.extend({
    className: 'krimi-main-view',
    template: _.template(jQuery("#krimi-main-menu").html()),
    // el - stands for element. Every view has a element associate in with HTML
    //      content will be rendered.
    el: '#oc_krimi_app',
    // It's the first function called when this view it's instantiated.
    initialize: function(){
      this.render();
    },
    events: {
    'click #krimi_similar_authors_books_button': 'Show_similar_authors_in_genre',
    'click #krimi_genre_view_button': 'show_book_genres',
    'click #krimi_same_main_char_button': 'Show_similar_books_by_main_char',
    'click #krimi_same_location_button': 'Show_similar_books_by_location',
    },
    // $el - it's a cached jQuery object (el), in which you can use jQuery functions
    //       to push content. Like the Hello World in this case.
    render: function(){
      this.$el.html(this.template());
      //jQuery('#krimi_similar_books_button').click(this.Get_similar_books_by_isbn);
    },
    show_book_genres: function(){
            // Fetch the collection and call render() method
            krimi_app.book_genres.fetch_rdf({
              success: function () {
                  krimi_app.show_genres.render();
              }
            },Drupal.settings.oc_krimi_siden.author);  
    },
    Show_similar_authors_in_genre: function()
    {
        // Fetch the collection and call render() method
        krimi_app.books_in_viewed_book_genre_rdf.fetch_rdf_authors_in_same_category({
          success: function () {
              krimi_app.show_authors_in_viewd_book_genre.render();
          }
        },Drupal.settings.oc_krimi_siden.faust);
    },
    Show_similar_books_by_main_char: function(){
        
        krimi_app.books_with_similar_main_char_rdf.fetch_rdf({
          success: function () {
              krimi_app.SimilarBooksbyMainChar.render();
          }
        },Drupal.settings.oc_krimi_siden.mainchar);
        
    },
    Show_similar_books_by_location: function(){
        
        krimi_app.books_with_similar_location_rdf.fetch_rdf({
          success: function () {
              krimi_app.SimilarBooksbyLocation.render();
          }
        },Drupal.settings.oc_krimi_siden.location);
        
    },
  });
  /*
   * init all objects.
   */
    krimi_app.book_genres = new krimi_app.book_genres();
    krimi_app.books_by_author_rdf = new krimi_app.books_by_author_rdf();
    krimi_app.books_in_viewed_book_genre_rdf = new krimi_app.books_in_viewed_book_genre_rdf();
    krimi_app.books_with_similar_main_char_rdf = new krimi_app.books_with_similar_main_char_rdf();
    krimi_app.books_with_similar_location_rdf = new krimi_app.books_with_similar_location_rdf();
   
    krimi_app.show_authors_in_viewd_book_genre = new krimi_app.show_authors_in_viewd_book_genre();
    krimi_app.show_genre_similar_items = new krimi_app.show_genre_similar_items();
    krimi_app.show_genres = new krimi_app.show_genres();
    krimi_app.SimilarBooks = new krimi_app.SimilarBooks();
    krimi_app.SimilarBooksbyMainChar = new krimi_app.SimilarBooksbyMainChar();
    krimi_app.SimilarBooksbyLocation = new krimi_app.SimilarBooksbyLocation();
    
    
    krimi_app.MainView = new krimi_app.MainView();
});
