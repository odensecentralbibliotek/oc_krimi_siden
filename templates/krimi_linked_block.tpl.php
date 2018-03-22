<?php ?>
<div class="krimi-wrapper">
  <div id="oc_krimi_app"></div>
</div>

<script type="text/template" id="krimi-main-menu">
  <div class="main-krimi-header"><h2>Find relaterede krimibøger</h2><p>Gå på opdagelse i krimisidens database og find inspiration til dit næste lån</p></div>
    <div class="main-krimi-buttons Grid Grid--gutters Grid--full large-Grid--fit">
      <div class="Grid-cell">
        <div class="Cell-content">
          <a id="krimi_similar_authors_books_button" >
            <div class="Linked_data_button">
              <div class="krimi-css-btn">
                <span>Find forfattere som minder om</span>
              </div>
            </div>
          </a>
        </div>
      </div>
      <div class="Grid-cell">
        <div class="Cell-content">
          <a id="krimi_genre_view_button" >
            <div class="Linked_data_button">   
              <div class="krimi-css-btn">
                <span>Find bøger som har lignende Genrer</span>
              </div>
            </div>
          </a>
        </div>
      </div>  
      <div class="Grid-cell">
        <div class="Cell-content">
          <a id="krimi_same_location_button" >
            <div  class="Linked_data_button" >
              <div class="krimi-css-btn">
                <span>Find bøger som foregår på samme lokation</span>
              </div>    
            </div>
          </a>
        </div>
      </div>
      <div class="Grid-cell">
        <div class="Cell-content">
          <a id="krimi_same_main_char_button" >
            <div  class="Linked_data_button" >    
              <div class="krimi-css-btn">
                <span>Find bøger som har samme hovedperson</span>
              </div>
            </div> 
          </a>
        </div>
      </div>  
    </div>
  </div>   
</script>

<!-- View1: Authors in similar genres -->
<script type="text/template" id="krimi-authors-in-genre">
  <div>
    <h2>Forfatterer som skriver i samme genre som valgt forfatter.</h2>
    <div class="oc-krimi-menu"> 
      <a id="krimi_goto_menu_btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    </div>
    <div>
      <div id="paginator" class="Grid Grid--gutters Grid--full large-Grid--fit">
        <% _.each(authors.models, function(author) { %>                 
          <a id="<%= author.get('author').value %>" class="Grid-cell krimi-follow-author-in-genre Linked_data_button">
            <div class="Cell-content">
              <img class="krimi-author-profile-image" src="<?php echo "/" . drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" />
              <h4><%= author.get('author').value %></h4>
            </div>
          </a> 
        <% }); %>
      </div>
    </div>
  </div>  
</script>

<!-- View2: Books by author -->
<script type="text/template" id="krimi-similar-books">
  <h2>Bøger</h2>        
  <div class="krimi_similar_view">
    <div class="oc-krimi-menu"> 
      <a class="krimi-back-btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
      <a id="krimi_goto_menu_btn" class="button">Menu</i></a>
    </div>
    <div id="paginator" class="Grid Grid--gutters Grid--full large-Grid--fit">
      <% _.each(similar.models, function(similarItem) { %>
        <div class="krimi-cover-image Grid-cell">
          <a id="<%= similarItem.get('identifier') %>" class="Cell-content similar-item krimi-follow-similar">
            <img src="<%= similarItem.get('image') %>" title="<%= similarItem.get('name') %>" onerror="this.onerror=null;this.src='https://dummyimage.com/400X600/000/000';"/>  
              <% var fausts = ''; _.each(similarItem.get('productID'), function(faustNumber,i) {
                var split = faustNumber.split(':');
                if(i == 0) 
                {fausts += split[1];}
                else
                {fausts += ' OR ' +split[1];}
              %>  
              <% }); 
              %>
            <h4><%= similarItem.get('name') %></h4>  
            <input id="faust" type="hidden" value="<%= fausts %>" />
          </a>
        </div>
      <% }); %>
    </div>
  </div>
</script>

<!-- View1: Genres -->
<script type="text/template" id="krimi-books-genre">
    <h2>Lignende genrer</h2>            
    <div class="oc-krimi-menu"> 
      <a id="krimi_goto_menu_btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    </div>
    <div class="krimi_genres">
    <div class="Grid Grid--gutters Grid--full large-Grid--fit">  
      <% _.each(genres.models, function(genre) { %>
        <div class="Grid-cell">
          <div class="Cell-content">   
          <a id="<%= genre.get('identifier').value %>" class="krimi-follow-similar-genre Linked_data_button Grid-cell">

              <img src="<%= '/sites/all/modules/custom/oc_krimi_siden/images/' + (genre.get('genre_billede').value).replace('/','').replace('?','') %>" />
              <div class="genre-title">
                  <h4><%= genre.get('label').value %></h4>
              </div>

      </a></div></div> 
      <% }); %>
    </div>
    </div>
</script>

<!-- View2: Books by genre -->
<script type="text/template" id="krimi-genre-similar-books">
    <div class="krimi_similar_view">
    <h2>Bøger i Genre</h2>
    <div class="oc-krimi-menu"> 
      <a class="krimi-genre-back-btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
      <a id="krimi_goto_menu_btn" class="button">Menu</a>
    </div>
    <div id="paginator" class="Grid Grid--gutters Grid--full large-Grid--fit">
    <% _.each(similar.models, function(similarItem) { %>
    <div class="krimi-cover-image Grid-cell">
      <a id="<%= similarItem.get('identifier') %>" class="Cell-content similar-item krimi-follow-similar"><img src="<%= similarItem.get('image') %>" title="<%= similarItem.get('name') %>" />
      <h4><%= similarItem.get('name') %></h4>
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

<!-- View1: Locations -->
<script type="text/template" id="krimi-locations-books">
  <h2>Lokationer</h2>
  <div class="krimi_similar_view">
    <div class="oc-krimi-menu"> 
      <a class="krimi_goto_menu_btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    </div>
    <div id="paginator" class="Grid Grid--gutters Grid--full large-Grid--fit">
      <% _.each(similar.models, function(similarItem) { %>
        <div class="Grid-cell">
        <div class="Cell-content-location">
          <a id="<%= similarItem.get('sted_city').value %>" class="krimi_book_locations">
            <img src="<%= '/sites/all/modules/custom/oc_krimi_siden/images/' + similarItem.get('sted_city').value + '.jpg' %>" />
            <h4><%= similarItem.get('sted_city').value %></h4>
          </a>
      </div>  
        </div>
        <div class="Grid-cell">
        <div class="Cell-content-location">
          <a id="<%= similarItem.get('sted_land').value %>" class="krimi_book_locations">
            <img src="<%= '/sites/all/modules/custom/oc_krimi_siden/images/' + similarItem.get('sted_land').value + '.jpg' %>" />
            <h4><%= similarItem.get('sted_land').value %></h4>
          </a>
      </div>  
        </div>
      <% }); %>
    </div>
  </div>
</script>

<!-- View2: Books by location -->
<script type="text/template" id="krimi-similar-by_lokationer_tpl">
  <h2>Bøger på lokation</h2>  
    <div class="krimi_similar_view">
    <div class="oc-krimi-menu">
      <a class="krimi-back-btn_location"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
      <a id="krimi_goto_menu_btn" class="button">Menu</a> 
    </div>
    <div id="paginator" class="Grid Grid--gutters Grid--full large-Grid--fit">
    <% _.each(similar.models, function(similarItem) { %>
    <div class="krimi-cover-image Grid-cell">
      <a id="<%= similarItem.get('identifier') %>" class="Cell-content lokation-similar-item krimi-follow-similar"><img src="<%= similarItem.get('image') %>" title="<%= similarItem.get('name') %>"  onerror="this.onerror=null;this.src='https://dummyimage.com/400X600/000/000';"/>
      <h4><%= similarItem.get('name') %></h4>  
    
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

<!-- View1: Characters -->
<script type="text/template" id="krimi-characters-books">
  <h2>Hovedpersoner</h2>
  <div class="krimi_similar_view">
    <div class="oc-krimi-menu"> 
      <a class="krimi-back-btn_location"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
    </div>
    <div class="Grid Grid--gutters Grid--full large-Grid--fit">  
      <% _.each(similar.models, function(similarItem) { %>
        <div class="Grid-cell">
          <div class="Cell-content">
            <a id="<%= similarItem.get('label').value %>" class="books_with_character" >
              <img src="https://dummyimage.com/400X600/000/000'"/>  
              <h4><%= similarItem.get('label').value %></h4></a>
          </div>
        </div>    
      <% }); %>
    </div>
  </div>
</script>

<!-- View2: Books by character -->
<script type="text/template" id="krimi-similar-by_character_tpl">
  <h2>Personer</h2>
  <div class="krimi_similar_view">
    <div class="oc-krimi-menu"> 
      <a class="krimi-back-btn_main_char"><span style="font-weight: 800; font-size: 4px; margin-right: -8px; text-decoration: none; overflow: hidden;">|</span><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
      <a id="krimi_goto_menu_btn" class="button">Menu</a>
    </div>
    <div id="paginator" class="Grid Grid--gutters Grid--full large-Grid--fit">
    <% _.each(similar.models, function(similarItem) { %>
    <div class="krimi-cover-image Grid-cell">
      <a id="<%= similarItem.get('identifier') %>" class="Cell-content main-char-similar-item krimi-follow-similar"><img src="<%= similarItem.get('image') %>" title="<%= similarItem.get('name') %>" onerror="this.onerror=null;this.src='https://dummyimage.com/400X600/000/000';" />
      <h4><%= similarItem.get('name') %></h4>  
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

<!--- Popup template-->
<script type="text/template" id="krimi-display-similar-book">
  <div>
    <div><img src="<%= entity.get('image') %>" title="<%= entity.get('name') %>" /></div>
    <div><b>Navn:</b><%= entity.get('name') %></div>
    <div><b>Beskrivelse:</b><%= entity.get('description') %></div>
    <br/>
    <div><a class="pop_up_search_link" target="_blank" href="<%= '/search/ting/' + query %>">Lån Bogen</a></div>
  </div>
</script>

<!-- No Results-->
<script type="text/template" id="krimi-display-no-results">
  <div class="oc-krimi-menu"> 
    <a id="krimi_goto_menu_btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
  </div>
  <h2>Vi fandt desværre ikke brugbare resultater.</h2>
</script>

<!---end -->
<div id="krimi-dialog" title="Informationer" style="display:none;">
    <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>