jQuery(document).ready(function () {
  /*
   * View authors in viewed book genres
   */
  krimi_app.show_authors_in_viewd_book_genre = Backbone.View.extend({
    className: 'krimi-author-in-viewd-book-genres-items-view',
    el: '#oc_krimi_app',
    initialize: function () {

      // create a collection
      //this.render();
    },
    events: {
      'click #krimi_browser_author': 'display_genre_author_book_items',
      'click .krimi-follow-author-in-genre': 'Get_books_by_author',
    },
    render: function () {
      if (krimi_app.books_in_viewed_book_genre_rdf.length != 0) {
        this.template = _.template(jQuery("#krimi-authors-in-genre").html());
        this.$el.html(this.template({
          "authors": krimi_app.books_in_viewed_book_genre_rdf
        }));
        jQuery('#paginator').easyPaginate({
          paginateElement: 'a',
          elementsPerPage: 12,
          effect: 'fade'
        });
      } else {
        this.template = _.template(jQuery("#krimi-display-no-results").html());
        this.$el.html(this.template());
      }
    },
    goto_menu: function () {
      krimi_app.MainView.render();
    },
    Get_books_by_author: function (ev) {
      var id = jQuery(ev.currentTarget).attr('id');
      // Fetch the collection and call render() method
      krimi_app.books_by_author_rdf.fetch_rdf({
        success: function () {
          krimi_app.SimilarBooks.render();
        }
      }, id);
    },
  });

  /*
   * View book similar genres
   */
  krimi_app.show_genre_similar_items = Backbone.View.extend({
    className: 'krimi-genre-similar-items-view',
    el: '#oc_krimi_app',
    initialize: function () {

      // create a collection
      //this.render();
    },
    events: {
      'click #krimi_browser_genre': 'display_similar_genre_items',
      'click .krimi-genre-back-btn': 'go_back',
    },
    render: function () {
      if (krimi_app.books_by_author_rdf.length != 0) {
        this.template = _.template(jQuery("#krimi-genre-similar-books").html());
        this.$el.html(this.template({
          "similar": krimi_app.books_by_author_rdf
        }));
        jQuery('#paginator').easyPaginate({
          paginateElement: 'div',
          elementsPerPage: 9,
          effect: 'fade'
        });
      } else {
        this.template = _.template(jQuery("#krimi-display-no-results").html());
        this.$el.html(this.template());
      }
    },
    goto_menu: function () {
      krimi_app.MainView.render();
    },
    go_back: function () {
      krimi_app.MainView.show_book_genres();
    },
    display_similar_genre_items: function (e) {
      //Render the similar items by genre
    }
  });

  /*
   * View genres
   */
  krimi_app.show_genres = Backbone.View.extend({
    className: 'krimi-genre-view',
    el: '#oc_krimi_app',
    initialize: function () {

      // create a collection
      //this.render();
    },
    events: {
      'click .krimi-follow-similar-genre': 'display_genre_item',
      'click #krimi_goto_menu_btn': 'goto_menu',
    },
    render: function () {

      this.template = _.template(jQuery("#krimi-books-genre").html());
      this.$el.html(this.template({
        "genres": krimi_app.book_genres
      }));
    },
    goto_menu: function () {
      krimi_app.MainView.render();
    },
    display_genre_item: function (e) {
      //Render the similar items by genre
      // Fetch the collection and call render() method
      /*
       * & in url values needs to be encoded , or it breaks request.
       */
      var genre_name = jQuery(e.currentTarget).attr("id").replace('&', '%26');
      krimi_app.books_by_author_rdf.fetch_rdf_by_genre({
        success: function () {
          krimi_app.show_genre_similar_items.render();
        }
      }, genre_name);
    }
  });

  /*
   * View similar items selected author
   */
  krimi_app.SimilarBooks = Backbone.View.extend({
    className: 'krimi-similar-view',
    el: '#oc_krimi_app',
    initialize: function () {

      // create a collection
      //this.render();
    },
    events: {
      'click #krimi_goto_menu_btn': 'goto_menu',
      'click .similar-item': 'display_item',
      'click .krimi-back-btn': 'krimi_go_back',
    },
    render: function () {
      this.template = _.template(jQuery("#krimi-similar-books").html());
      this.$el.html(this.template({
        "similar": krimi_app.books_by_author_rdf
      }));
      jQuery('#paginator').easyPaginate({
        paginateElement: 'div',
        elementsPerPage: 8,
        effect: 'fade'
      });
    },
    goto_menu: function () {
      krimi_app.MainView.render();
    },
    krimi_go_back: function () {
      krimi_app.MainView.Show_similar_authors_in_genre();
    },
    display_item: function (e) {
      var target = jQuery(e.currentTarget);
      var query_string = target.find('#faust').attr('value');
      var found = krimi_app.books_by_author_rdf.findWhere({
        'identifier': target.attr('id')
      });
      var tmpl = _.template(jQuery('#krimi-display-similar-book').html());
      var html = tmpl({
        'entity': found,
        'query': query_string
      });
      jQuery("#krimi-dialog").html(html);

      jQuery("#krimi-dialog").dialog();
    }
  });
  /*
   * View similar items with same main char
   */
  krimi_app.SimilarBooksbyCharacter = Backbone.View.extend({
    className: 'krimi-similar-main-char-view',
    el: '#oc_krimi_app',
    template: null,
    initialize: function () {

      // create a collection
      //this.render();
    },
    events: {
      'click #krimi_goto_menu_btn': 'goto_menu',
      'click .main-char-similar-item': 'display_item',
      'click .krimi-back-btn_main_char': 'krimi_main_chargo_back',
    },
    render: function () {
      if (krimi_app.books_with_similar_character_rdf.length != 0) {
        this.template = _.template(jQuery("#krimi-similar-by_character_tpl").html());
        this.$el.html(this.template({
          "similar": krimi_app.books_with_similar_character_rdf
        }));
        jQuery('#paginator').easyPaginate({
          paginateElement: 'div',
          elementsPerPage: 9,
          effect: 'fade'
        });
      } else {
        this.template = _.template(jQuery("#krimi-display-no-results").html());
        this.$el.html(this.template());
      }
    },
    goto_menu: function () {
      krimi_app.MainView.render();
    },
    krimi_main_chargo_back: function () {
      krimi_app.show_character_items.render();
    },
    display_item: function (e) {
      var target = jQuery(e.currentTarget);
      var query_string = target.find('#faust').attr('value');
      var found = krimi_app.books_with_similar_character_rdf.findWhere({
        'identifier': target.attr('id')
      });
      var tmpl = _.template(jQuery('#krimi-display-similar-book').html());
      var html = tmpl({
        'entity': found,
        'query': query_string
      });
      jQuery("#krimi-dialog").html(html);
      jQuery("#krimi-dialog").dialog();
    }
  });


  /*
   * View book locations
   */
  krimi_app.show_location_items = Backbone.View.extend({
    className: 'krimi-locations-items-view',
    el: '#oc_krimi_app',
    initialize: function () {

      // create a collection
      //this.render();
    },
    events: {
      'click .krimi_book_locations': 'display_location_items',
      'click .krimi-genre-back-btn': 'go_back',
      'click .krimi_goto_menu_btn': 'go_menu',
    },
    render: function () {
      if (krimi_app.locations_rdf.length != 0) {
        this.template = _.template(jQuery("#krimi-locations-books").html());
        this.$el.html(this.template({
          "similar": krimi_app.locations_rdf
        }));
        jQuery('#paginator').easyPaginate({
          paginateElement: 'div',
          elementsPerPage: 9,
          effect: 'fade'
        });
      } else {
        this.template = _.template(jQuery("#krimi-display-no-results").html());
        this.$el.html(this.template());
      }
    },
    go_menu: function () {
      krimi_app.MainView.render();
    },
    go_back: function () {
      krimi_app.MainView.show_book_genres();
    },
    display_location_items: function (e) {
      var id = jQuery(e.currentTarget).attr('id');
      krimi_app.books_with_similar_location_rdf.fetch_rdf({
        success: function () {
          krimi_app.SimilarBooksbyLocation.render();
        }
      }, id);
    }
  });

  /*
   * View similar items with same location
   */
  krimi_app.SimilarBooksbyLocation = Backbone.View.extend({
    className: 'krimi-similar-location-view',
    el: '#oc_krimi_app',
    template: null,
    initialize: function () {

      // create a collection
      //this.render();
    },
    events: {
      'click #krimi_goto_menu_btn': 'goto_menu',
      'click .lokation-similar-item': 'display_item',
      'click .krimi-back-btn_location': 'krimi_location_back',
    },
    render: function () {
      if (krimi_app.books_with_similar_location_rdf.length != 0) {

        this.template = _.template(jQuery("#krimi-similar-by_lokationer_tpl").html());
        this.$el.html(this.template({
          "similar": krimi_app.books_with_similar_location_rdf
        }));
        jQuery('#paginator').easyPaginate({
          paginateElement: 'div',
          elementsPerPage: 9,
          effect: 'fade'
        });
      } else {
        this.template = _.template(jQuery("#krimi-display-no-results").html());
        this.$el.html(this.template());
      }
    },
    goto_menu: function () {
      krimi_app.MainView.render();
    },
    krimi_location_back: function () {
      krimi_app.MainView.render();
    },
    display_item: function (e) {
      var target = jQuery(e.currentTarget);
      var query_string = target.find('#faust').attr('value');
      var found = krimi_app.books_with_similar_location_rdf.findWhere({
        'identifier': target.attr('id')
      });
      var tmpl = _.template(jQuery('#krimi-display-similar-book').html());
      var html = tmpl({
        'entity': found,
        'query': query_string
      });
      jQuery("#krimi-dialog").html(html);
      jQuery("#krimi-dialog").dialog();
    }
  });

  /*
   * View book characters
   */
  krimi_app.show_character_items = Backbone.View.extend({
    className: 'krimi-characters-items-view',
    el: '#oc_krimi_app',
    initialize: function () {

      // create a collection
      //this.render();
    },
    events: {
      'click .books_with_character': 'display_character_items',
      'click .krimi-genre-back-btn': 'go_back',
    },
    render: function () {
      if (krimi_app.characters_rdf.length != 0) {
        this.template = _.template(jQuery("#krimi-characters-books").html());
        this.$el.html(this.template({
          "similar": krimi_app.characters_rdf
        }));
        jQuery('#paginator').easyPaginate({
          paginateElement: 'div',
          elementsPerPage: 9,
          effect: 'fade'
        });
      } else {
        this.template = _.template(jQuery("#krimi-display-no-results").html());
        this.$el.html(this.template());
      }
    },
    goto_menu: function () {
      krimi_app.MainView.render();
    },
    go_back: function () {
      krimi_app.MainView.render();
    },
    display_character_items: function (e) {
      var id = jQuery(e.currentTarget).attr('id');
      krimi_app.books_with_similar_character_rdf.fetch_rdf({
        success: function () {
          krimi_app.SimilarBooksbyCharacter.render();
        }
      }, id);
    }
  });


});
