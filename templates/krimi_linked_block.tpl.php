<?php ?>
<div class="krimi-wrapper">
    <div id="oc_krimi_app">
        
    </div>
</div>

<script type="text/template" id="krimi-main-menu">
<div>
    <div class="main-krimi-header"><b>Gå på odagelse i krimisidens database og find inspiration til dit næste lån</b></div>
    <div class="main-krimi-buttons" >
     <a id="krimi_similar_authors_books_button" >
        <div  class="Linked_data_button">
           
                    <div class="krimi-css-btn">
                        <span>Find forfattere som minder om</span>
                    </div>
        </div>
        </a>
        <a id="krimi_genre_view_button" >
        <div  class="Linked_data_button">
            
                <div class="krimi-css-btn">
                    <span>Find bøger som har lignende Genrer</span>
                </div>
        </div>
        </a>
        <a id="krimi_same_location_button" >
        <div  class="Linked_data_button" >
            
                    <div class="krimi-css-btn">
                        <span>Find bøger som foregår på samme lokation</span>
                    </div>    
        </div>
        </a>
        <a id="krimi_same_main_char_button" >
        <div  class="Linked_data_button" >
            
                    <div class="krimi-css-btn">
                        <span>Find bøger som har samme hovedeperson</span>
                    </div>
            </a>
        </div>
        </a>
    </div>
</div>
    
</script>
<!--- view: Genre selection --->
<script type="text/template" id="krimi-genre-similar-books">
    <div class="krimi_similar_view">
    <h2>Bøger i Genre</h2>
    <div class="oc-krimi-menu"> 
    <a class="krimi-genre-back-btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    <a id="krimi_goto_menu_btn">menu</a>
    </div>
    <div id="paginator">
    <% _.each(similar.models, function(similarItem) { %>
    <div class="krimi-cover-image">
    <a id="<%= similarItem.get('identifier') %>" class="similar-item krimi-follow-similar"><img src="<%= similarItem.get('image') %>" title="<%= similarItem.get('name') %>" />
   <% var fausts = ''; _.each(similarItem.get('productID'), function(faustNumber,i) {
        var split = faustNumber.split(':');
        if(i == 0)
        {
            fausts += split[1];
        }
        else
        {
            fausts += ' OR ' +split[1];
        }
                 %>
     <% }); %>
    <input id="faust" type="hidden" value="<%= fausts %>" />
    </a>
    </div>
    <% }); %>
     </div>
    </div>
</script>
<!--- book genres -->
<script type="text/template" id="krimi-books-genre">
    <div class="oc-krimi-menu"> 
    <h2>Lignende genrer</h2>
    <a id="krimi_goto_menu_btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    </div>
    <div>

    <% _.each(genres.models, function(genre) { %>
        
    <a id="<%= genre.get('identifier').value %>" class="krimi-follow-similar-genre Linked_data_button">
        <div class="oc-krimi-genre-wrap" >
            <img src="<%= '/sites/all/modules/custom/oc_krimi_siden/images/' + (genre.get('genre_billede').value).replace('/','').replace('?','') %>" />
            <div>
                <span><%= genre.get('label').value %></span>
            </div>
        </div>
    </a>
    <% }); %>
    </div>
</script>

<!--- view: books by author --->
<script type="text/template" id="krimi-similar-books">
    <div class="krimi_similar_view">
    <div class="oc-krimi-menu"> 
    <a class="krimi-back-btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    <a id="krimi_goto_menu_btn">menu</a>
    </div>
    <div id="paginator">
    <% _.each(similar.models, function(similarItem) { %>
    <div class="krimi-cover-image">
    <a id="<%= similarItem.get('identifier') %>" class="similar-item krimi-follow-similar"><img src="<%= similarItem.get('image') %>" title="<%= similarItem.get('name') %>" />
        <% var fausts = ''; _.each(similarItem.get('productID'), function(faustNumber,i) {
        var split = faustNumber.split(':');
        if(i == 0)
        {
            fausts += split[1];
        }
        else
        {
            fausts += ' OR ' +split[1];
        }
                 %>
     <% }); %>
    <input id="faust" type="hidden" value="<%= fausts %>" />
    </a>
    </div>
    <% }); %>
    </div>
    </div>
</script>
<!--- view: books by author --->
<script type="text/template" id="krimi-similar-by_main_char_tpl">
    <div class="krimi_similar_view">
    <div class="oc-krimi-menu"> 
    <a class="krimi-back-btn_main_char"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    </div>
    <div id="paginator">
    <% _.each(similar.models, function(similarItem) { %>
    <div class="krimi-cover-image">
    <a id="<%= similarItem.get('identifier') %>" class="main-char-similar-item krimi-follow-similar"><img src="<%= similarItem.get('image') %>" title="<%= similarItem.get('name') %>" />
       <% var fausts = ''; _.each(similarItem.get('productID'), function(faustNumber,i) { 
        var split = faustNumber.split(':');
        if(i == 0)
        {
            fausts += split[1];
        }
        else
        {
            fausts += ' OR ' +split[1];
        }
                 %>
     <% }); %>
    <input id="faust" type="hidden" value="<%= fausts %>" />
    </a>
    
    </div>
    <% }); %>
    </div>
    </div>
</script>
<!--- view: books by lokation --->
<script type="text/template" id="krimi-similar-by_lokationer_tpl">
    <div class="krimi_similar_view">
    <div class="oc-krimi-menu"> 
    <a class="krimi-back-btn_location"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    </div>
    <div id="paginator">
    <% _.each(similar.models, function(similarItem) { %>
    <div class="krimi-cover-image">
    <a id="<%= similarItem.get('identifier') %>" class="lokation-similar-item krimi-follow-similar"><img src="<%= similarItem.get('image') %>" title="<%= similarItem.get('name') %>" />
    <% var fausts = ''; _.each(similarItem.get('productID'), function(faustNumber,i) { 
                 
                 
        var split = faustNumber.split(':');
        if(i == 0)
        {
            fausts += split[1];
        }
        else
        {
            fausts += ' OR ' +split[1];
        }
                 %>
     <% }); %>
    <input id="faust" type="hidden" value="<%= fausts %>" />
    </a>
    </div>
    <% }); %>
    </div>
    </div>
</script>
<!--- view: books by genre --->
<script type="text/template" id="krimi-genre-similar-books">
    <div class="krimi_similar_genre_view">
    <div class="oc-krimi-menu"> 
    <a class="krimi-genre-back-btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    <a id="krimi_goto_menu_btn">menu</a>
    </div>
    <div id="paginator">
    <% _.each(similar.models, function(similarItem) { %>
    <div class="krimi-cover-image">
    <a id="<%= similarItem.get('identifier') %>" class="similar-item krimi-follow-similar"><img src="<%= similarItem.get('image') %>" title="<%= similarItem.get('name') %>" />
        <% var fausts = ''; _.each(similarItem.get('productID'), function(faustNumber,i) { 
                 
                 
        var split = faustNumber.split(':');
        if(i == 0)
        {
            fausts += split[1];
        }
        else
        {
            fausts += ' OR ' +split[1];
        }
                 %>
     <% }); %>
    <input id="faust" type="hidden" value="<%= fausts %>" />
    </a>
    </div>
    <% }); %>
    </div>
    </div>
</script>
<!--- Popup template--->
<script type="text/template" id="krimi-display-similar-book">
    <div><img src="<%= entity.get('image') %>" title="<%= entity.get('name') %>" /></div>
    <div><b>Navn:</b><%= entity.get('name') %></div>
    <div><b>Beskrivelse:</b><%= entity.get('description') %></div>
    <br/>
    <div><a class="pop_up_search_link" target="_blank" href="<%= '/search/ting/' + query %>">Lån Bogen</a></div>
</script>

<!-- View similar authors in genre--->
<script type="text/template" id="krimi-authors-in-genre">
    <h2>Forfaterer som skriver i samme genre</h2>
    <div class="oc-krimi-menu"> 
    <a id="krimi_goto_menu_btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    </div>
    <div>
    <div id="paginator">
    <% _.each(authors.models, function(author) { %>
    <a id="<%= author.get('author').value %>" class="krimi-follow-author-in-genre Linked_data_button">
    <div class="oc-krimi-genre-wrap" >
        <img class="krimi-author-profile-image" src="<?php echo "/" . drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" />
         <div>
            <%= author.get('author').value %>
         </div>
    </div>
    </a>
    <% }); %>
    </div>
    </div>
</script>

<!--- No Results--->
<script type="text/template" id="krimi-display-no-results">
    <div class="oc-krimi-menu"> 
    <a id="krimi_goto_menu_btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    </div>
   <h2>Vi fandt desværre ikke brugbare resultater.</h2>
   <span>Kontakt <a href="krimisiden.dk">krimisiden.dk</a> hvis du mener her mangler noget.</span>
</script>
<!---end -->
<div id="krimi-dialog" title="Informationer" style="display:none;">
    <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>