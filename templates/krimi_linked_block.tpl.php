<?php ?>
<div class="krimi-wrapper">
    <div id="oc_krimi_menu"></div>
    <div id="oc_krimi_app">

    </div>
</div>

<script type="text/template" id="krimi-main-menu">
    <div class="view">
    <div><span><b>Gå på odagelse i krimisidens database og find inspiration til dit næste lån</b></span><br/><br/></div>
    <a id="krimi_similar_books_button" class="Linked_data_button">
        <div id="oc_krimi_top_1" class="oc-krimi-main-wrap"  >
            <div class="">
               <img  src="<?php echo "/" . drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" />
            </div>
            <div>
                 <span>Lignende Forfattere</span>
            </div>
        </div>
    </a>
    <a id="krimi_genre_view_button" class="Linked_data_button">
        <div class="oc-krimi-main-wrap" >
            <div>
              <img  src="<?php echo "/" . drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" />
            </div>
            <div >
                 <span>lignende Genre</span>
            </div>
        </div>
    </a>
     <a class="Linked_data_button">
        <div id="oc_krimi_top_3" class="oc-krimi-main-wrap" >
            <div>
                <img  src="<?php echo "/" . drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" />
            </div>
            <div>
              <span>lignende Steder?</span>
            </div>
        </div>
    </a>
    <a class="Linked_data_button">
        <div id="oc_krimi_top_4" class="oc-krimi-main-wrap" >
            <div>
                 <img  src="<?php echo "/" . drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" />
            </div>
            <div>
                <span>Samme Hovedeperson?</span>
            </div>
        </div>
    </a>
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

    <% _.each(similar.models, function(similarItem) { %>
    <div class="krimi-cover-image">
    <a id="<%= similarItem.get('identifier') %>" class="similar-item krimi-follow-similar"><img src="<%= similarItem.get('image') %>" title="<%= similarItem.get('name') %>" /></a>
    </div>
    <% }); %>
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
            <img src="<%= genre.get('genre_billede').value %>" />
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
    <% _.each(similar.models, function(similarItem) { %>
    <div class="krimi-cover-image">
    <a id="<%= similarItem.get('identifier') %>" class="similar-item krimi-follow-similar"><img src="<%= similarItem.get('image') %>" title="<%= similarItem.get('name') %>" /></a>
    </div>
    <% }); %>
    </div>
</script>
<!--- view: books by genre --->
<script type="text/template" id="krimi-genre-similar-books">
    <div class="krimi_similar_genre_view">
    <div class="oc-krimi-menu"> 
    <a class="krimi-genre-back-btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    <a id="krimi_goto_menu_btn">menu</a>
    </div>
    <% _.each(similar.models, function(similarItem) { %>
    <div class="krimi-cover-image">
    <a id="<%= similarItem.get('identifier') %>" class="similar-item krimi-follow-similar"><img src="<%= similarItem.get('image') %>" title="<%= similarItem.get('name') %>" /></a>
    </div>
    <% }); %>
    </div>
</script>
<!--- Popup template--->
<script type="text/template" id="krimi-display-similar-book">
    <div><img src="<%= entity.get('image') %>" title="<%= entity.get('name') %>" /></div>
    <div><b>Navn:</b><%= entity.get('name') %></div>
    <div><b>Beskrivelse:</b><%= entity.get('description') %></div>
    <br/>
    <div><a href="">Find lignende med værk</a></div>
    <div><a href="">Find lignende med genre</a></div>
    <div><a href="">Find lignende med sted</a></div>
    <div><a href="">find lignende med hovedeperson</a></div>
    <div><a href="">Lån Bogen</a></div>
</script>

<!-- View similar authors in genre--->
<script type="text/template" id="krimi-authors-in-genre">
    <h2>Forfaterer som skriver i samme genre</h2>
    <div class="oc-krimi-menu"> 
    <a id="krimi_goto_menu_btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    </div>
    <div>
    <% _.each(authors.models, function(author) { %>
    <a id="<%= author.get('author').value %>" class="krimi-follow-author-in-genre Linked_data_button">
    <div class="oc-krimi-genre-wrap" >
        <img class="krimi-author-profile-image" src="default.jpg" />
         <div>
            <%= author.get('author').value %>
         </div>
    </div>
    </a>
    <% }); %>
    </div>
</script>
<!---end -->
<div id="krimi-dialog" title="Linked Data handlings boks" style="display:none;">
    <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>