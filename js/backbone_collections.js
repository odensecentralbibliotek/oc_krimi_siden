jQuery( document ).ready(function() {
// Define the model
krimi_app.rdf_data = Backbone.Model.extend({});
// Get authors from viewed book genres
krimi_app.books_in_viewed_book_genre_rdf = Backbone.Collection.extend(
    {
        // Url to request when fetch() is called
        url:  krimi_app.app_data.get("service_url") +  krimi_app.app_data.get("get_authors_in_book_genre_sparql"),
        parse: function(response) {
           
            var test = response["results"]["bindings"];
            for (var i = 0, length = test.length; i < length; i++) {
                this.push(test[i]);
            }
            return this.models;
        },
        // Overwrite the sync method to pass over the Same Origin Policy
        sync: function(method, model, options) {
            var that = this;
                var params = _.extend({
                    type: 'GET',
                    dataType: 'json',
                    url: that.url,
                    processData: false
                }, options);
            return jQuery.ajax(params);
        },
        fetch_rdf: function( options, author ){
            
            this.reset();
            var _url = this.url;

            if( author ){
                this.url = this.url.replace("%#%",author);
            }
            this.fetch( options );

            this.url = _url;
        },
        fetch_rdf_authors_in_same_category: function(options, faust)
        {
          
            this.reset();
            var _url = this.url;
            this.url = krimi_app.app_data.get("service_url") +  krimi_app.app_data.get("get_authors_in_book_genre_sparql");
            if( faust ){
                this.url = this.url.replace("%#%",faust);
            }
            this.fetch( options );

            this.url = _url;
        }
    });
// Books by author rdf
krimi_app.books_by_author_rdf = Backbone.Collection.extend(
    {
        // Url to request when fetch() is called
        url:  krimi_app.app_data.get("service_url") +  krimi_app.app_data.get("get_books_by_author_sparql"),
        parse: function(response) {
            
            if(response["@graph"] != undefined)
            {
                var test = response["@graph"];
                for (var i = 0, length = test.length; i < length; i++) {
                    this.push(test[i]);
                }
             }
             else
             {
                 this.push(response);
             }
            return this.models;
        },
        // Overwrite the sync method to pass over the Same Origin Policy
        sync: function(method, model, options) {
            var that = this;
                var params = _.extend({
                    type: 'GET',
                    dataType: 'json',
                    url: that.url,
                    processData: false
                }, options);
            return jQuery.ajax(params);
        },
        fetch_rdf: function( options, author ){
            
            this.reset();
            var _url = this.url;

            if( author ){
                this.url = this.url.replace("%#%",author);
            }
            this.fetch( options );

            this.url = _url;
        },
        fetch_rdf_by_genre: function(options, genre)
        {

            this.reset();
            var _url = this.url;
            this.url =   krimi_app.app_data.get("get_books_by_genre_sparql");
           
            if( genre ){
                var nginx_not_like = genre.split("?");
                this.url = this.url.replace("%#%",nginx_not_like[1]);
                this.url = krimi_app.app_data.get("service_url") +this.url;
            }
            this.fetch( options );

            this.url = _url;
        }
    });
    // Get Book in same genres
    krimi_app.book_genres = Backbone.Collection.extend(
    {
    
        // Url to request when fetch() is called
        url:  krimi_app.app_data.get("service_url") +  krimi_app.app_data.get("get_book_genres_sparql"),
        parse: function(response) {
         
            var test =  response["results"]["bindings"];
            for (var i = 0, length = test.length; i < length; i++) {
                this.push(test[i]);
            }
            return this.models;
        },
        // Overwrite the sync method to pass over the Same Origin Policy
        sync: function(method, model, options) {
            var that = this;
                var params = _.extend({
                    type: 'GET',
                    dataType: 'json',
                    url: that.url,
                    processData: false
                }, options);
            return jQuery.ajax(params);
        },
        fetch_rdf: function( options , author ){
            this.reset();
            var _url = this.url;
            if( author ){
                this.url = this.url.replace("%#%",author);
            }
            this.fetch( options );

            this.url = _url;
        }
    });
    // Get Book with same main char
    krimi_app.books_with_similar_main_char_rdf = Backbone.Collection.extend(
    {
    
        // Url to request when fetch() is called
        url:   krimi_app.app_data.get("get_books_by_main_char_sparql"),
        parse: function(response) {
         if(response["@graph"] != undefined)
         {
            var test =  response["@graph"];
            for (var i = 0, length = test.length; i < length; i++) {
                this.push(test[i]);
            } 
         }
            return this.models;
        },
        // Overwrite the sync method to pass over the Same Origin Policy
        sync: function(method, model, options) {
            var that = this;
                var params = _.extend({
                    type: 'GET',
                    dataType: 'json',
                    url: that.url,
                    processData: false
                }, options);
            return jQuery.ajax(params);
        },
        fetch_rdf: function( options , mainchar ){
            this.reset();
            var _url = this.url;
            
            if( mainchar ){
                var nginx_not_like = mainchar.split("?");
                this.url = this.url.replace("%#%",nginx_not_like[1]);
                this.url = krimi_app.app_data.get("service_url") +this.url;
            }
            else
            {
                this.url = this.url.replace("%#%",'empty');
            }
            this.fetch( options );

            this.url = _url;
        }
    });
    // Get Book with same similar location
    krimi_app.books_with_similar_location_rdf = Backbone.Collection.extend(
    {
    
        // Url to request when fetch() is called
        url:   krimi_app.app_data.get("get_books_by_location_sparql"),
        parse: function(response) {
         if(response["@graph"] != undefined)
         {
            var test =  response["@graph"];
            for (var i = 0, length = test.length; i < length; i++) {
                this.push(test[i]);
            } 
         }
            return this.models;
        },
        // Overwrite the sync method to pass over the Same Origin Policy
        sync: function(method, model, options) {
            var that = this;
                var params = _.extend({
                    type: 'GET',
                    dataType: 'json',
                    url: that.url,
                    processData: false
                }, options);
            return jQuery.ajax(params);
        },
        fetch_rdf: function( options , mainchar ){
            this.reset();
            var _url = this.url;
            
            if( mainchar ){
                var nginx_not_like = mainchar.split("?");
                this.url = this.url.replace("%#%",nginx_not_like[1]);
                this.url = krimi_app.app_data.get("service_url") +this.url;
            }
            else
            {
                this.url = this.url.replace("%#%",'empty');
            }
            this.fetch( options );

            this.url = _url;
        }
    });
    
});



