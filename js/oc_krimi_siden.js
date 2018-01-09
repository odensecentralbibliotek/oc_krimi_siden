/*
 * Setup the backbone js to handle the browsing of linked data
 */
jQuery( document ).ready(function() {
     /*
     * View book genres
     */
    krimi_app.show_genre_similar_items = Backbone.View.extend({
        className: 'krimi-genre-similar-items-view',
        el: '#oc_krimi_app',
         initialize: function(){
            
          // create a collection
          //this.render();
        },
        events: {
        'click #krimi_browser_genre': 'display_similar_genre_items',
        },
        render: function(){
          debugger;
          this.template = _.template(jQuery("#krimi-genre-similar-books").html());
          this.$el.html(this.template({"similar": krimi_app.similar_by_author_collection}));
        },
        goto_menu: function(){
            krimi_app.MainView.render();  
        },
        display_similar_genre_items: function(e){
            //Render the similar items by genre
        }
    });
    /*
     * View books by genres
     */
    krimi_app.show_genres = Backbone.View.extend({
        className: 'krimi-genre-view',
        el: '#oc_krimi_app',
         initialize: function(){
            
          // create a collection
          //this.render();
        },
        events: {
        'click .krimi-follow-similar-genre': 'display_genre_item',
        'click #krimi_goto_menu_btn': 'goto_menu',
        },
        render: function(){
            
          this.template = _.template(jQuery("#krimi-books-genre").html());
          this.$el.html(this.template({"genres": krimi_app.book_genres}));
        },
        goto_menu: function(){
            krimi_app.MainView.render();  
        },
        display_genre_item: function(e){
            //Render the similar items by genre
             // Fetch the collection and call render() method
         var genre_name = jQuery(e.currentTarget).attr("id");
         krimi_app.similar_by_author_collection.fetch_rdf_by_genre({
            success: function () {
                krimi_app.show_genre_similar_items.render();
            }
          },genre_name);
        }
    });
    /*
     * View similar items
     */
    krimi_app.SimilarBooks = Backbone.View.extend({
        className: 'krimi-similar-view',
        el: '#oc_krimi_app',
         initialize: function(){
            
          // create a collection
          //this.render();
        },
        events: {
        'click #krimi_goto_menu_btn': 'goto_menu',
        'click .similar-item': 'display_item'
        },
        render: function(){
          this.template = _.template(jQuery("#krimi-similar-books").html());
          this.$el.html(this.template({"similar": krimi_app.similar_by_author_collection}));
        },
        goto_menu: function(){
            krimi_app.MainView.render();  
        },
        display_item: function(e){
            var target = jQuery(e.currentTarget);
            var found = krimi_app.similar_by_author_collection.findWhere({'identifier': target.attr('id')});
            var tmpl = _.template(jQuery('#krimi-display-similar-book').html());
            var html = tmpl({'entity': found});
            jQuery("#krimi-dialog").html(html);
            jQuery("#krimi-dialog").dialog();
        }
    });
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
    'click #krimi_similar_books_button': 'Get_similar_books_by_author',
    'click #krimi_genre_view_button': 'show_book_genres',
    },
    // $el - it's a cached jQuery object (el), in which you can use jQuery functions
    //       to push content. Like the Hello World in this case.
    render: function(){
      this.$el.html(this.template());
      //jQuery('#krimi_similar_books_button').click(this.Get_similar_books_by_isbn);
    },
    Get_similar_books_by_author:function(ev){
        // Fetch the collection and call render() method
        krimi_app.similar_by_author_collection.fetch_rdf({
          success: function () {
              krimi_app.SimilarBooks.render();
          }
        },Drupal.settings.oc_krimi_siden.author);
    },
    show_book_genres: function(){
            // Fetch the collection and call render() method
            krimi_app.book_genres.fetch_rdf({
              success: function () {
                  krimi_app.show_genres.render();
              }
            });  
    },
    Get_similar_books_by_isbn:function(ev){
    },
  });
    krimi_app.book_genres = new krimi_app.book_genres();
    krimi_app.similar_by_author_collection = new krimi_app.author_rdf();
   
    krimi_app.show_genre_similar_items = new krimi_app.show_genre_similar_items();
    krimi_app.show_genres = new krimi_app.show_genres();
    krimi_app.SimilarBooks = new krimi_app.SimilarBooks();
    krimi_app.MainView = new krimi_app.MainView();
});
