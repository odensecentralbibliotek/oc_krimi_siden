/*
 * Setup the backbone js to handle the browsing of linked data
 */
jQuery( document ).ready(function() {
     /*
     * View authors in viewd book genres
     */
    krimi_app.show_authors_in_viewd_book_genre = Backbone.View.extend({
        className: 'krimi-author-in-viewd-book-genres-items-view',
        el: '#oc_krimi_app',
         initialize: function(){
            
          // create a collection
          //this.render();
        },
        events: {
        'click #krimi_browser_author': 'display_genre_author_book_items',
        'click .krimi-follow-author-in-genre': 'Get_books_by_author',
        },
        render: function(){
          debugger;
          this.template = _.template(jQuery("#krimi-authors-in-genre").html());
          this.$el.html(this.template({"authors": krimi_app.books_in_viewed_book_genre_rdf}));
        },
        goto_menu: function(){
            krimi_app.MainView.render();  
        },
        Get_books_by_author:function(ev){
            debugger;
            var id = jQuery(ev.currentTarget).attr('id');
                // Fetch the collection and call render() method
                krimi_app.books_by_author_rdf.fetch_rdf({
                  success: function () {
                      krimi_app.SimilarBooks.render();
                  }
                },id);
            },
    });
    
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
          this.$el.html(this.template({"similar": krimi_app.books_by_author_rdf}));
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
             debugger;
             /*
              * & in url values needs to be encoded , or it breaks request.
              */
         var genre_name = jQuery(e.currentTarget).attr("id").replace('&','%26');
         krimi_app.books_by_author_rdf.fetch_rdf_by_genre({
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
          this.$el.html(this.template({"similar": krimi_app.books_by_author_rdf}));
        },
        goto_menu: function(){
            krimi_app.MainView.render();  
        },
        display_item: function(e){
            var target = jQuery(e.currentTarget);
            var found = krimi_app.books_by_author_rdf.findWhere({'identifier': target.attr('id')});
            var tmpl = _.template(jQuery('#krimi-display-similar-book').html());
            var html = tmpl({'entity': found});
            jQuery("#krimi-dialog").html(html);
            jQuery("#krimi-dialog").dialog();
        }
    });
});