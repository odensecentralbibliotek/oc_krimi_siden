<?php ?>
<style>
.Linked_data_button
{
    border: 1px solid black;
    width: 20%;
    display:inline-block;
}
.Linked_data_button img{
    width:50px;
    height: 50px;
}
.oc_krimi_wrap{
  width:100%;
  display:inline-block;  
  padding-left: 10px;
}
.krimi-cover-image
{
    display:inline-block;
   
}
.krimi-cover-image img
{
    height: 100%;
    width:150px;
}
</style>
<div class="krimi-wrapper">
    <div id="oc_krimi_menu"></div>
    <div id="oc_krimi_app">
        
    </div>
</div>

<script type="text/template" id="krimi-main-menu">
  <div class="view">
  <div id="oc_krimi_top_1" class="Linked_data_button"><div><img  src="<?php echo "/".drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" /></div><div><a id="krimi_similar_books_button">Forfatter</a></div></div>
    <div id="oc_krimi_top_2" class="Linked_data_button"><div><img  src="<?php echo "/".drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" /></div><div >Værk</div></div>
    <div id="oc_krimi_top_3" class="Linked_data_button"><div><img  src="<?php echo "/".drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" /></div><div ><a id="krimi_genre_view_button">Genre</a></div></div>
    <div id="oc_krimi_top_4" class="Linked_data_button"><div><img  src="<?php echo "/".drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" /></div><div>Sted</div></div>
    <div id="oc_krimi_top_4" class="Linked_data_button"><div><img  src="<?php echo "/".drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" /></div><div>Hovedeperson</div></div>
   </div>
</script>
<!--- view: Genre selection --->
<script type="text/template" id="krimi-genre-similar-books">
  <div class="krimi_similar_view">
    <div> 
        <a>frem</a>
        <a>tilbage</a>
        <a id="krimi_goto_menu_btn">menu</a>
    </div>
    <% _.each(similar.models, function(similarItem) { %>
      <div class="krimi-cover-image">
        <a id="<%= similarItem.get('identifier') %>" class="similar-item krimi-follow-similar"><img src="<%= similarItem.get('image') %>" title="<%= similarItem.get('name') %>" /></a>
      </div>
    <% }); %>
  </div>
</script>
<script type="text/template" id="krimi-books-genre">
<div> 
<a>frem</a>
<a>tilbage</a>
<a id="krimi_goto_menu_btn">menu</a>
</div>
<div>
 <% _.each(genres.models, function(genre) { %>
 <a id="<%= genre.get('label').value %>" class="krimi-follow-similar-genre"><%= genre.get('label').value %></a><br/>
<% }); %>
</div>
</script>

<!--- view: books by author --->
<script type="text/template" id="krimi-similar-books">
  <div class="krimi_similar_view">
    <div> 
        <a>frem</a>
        <a>tilbage</a>
        <a id="krimi_goto_menu_btn">menu</a>
    </div>
    <% _.each(similar.models, function(similarItem) { %>
      <div class="krimi-cover-image">
        <a id="<%= similarItem.get('identifier') %>" class="similar-item krimi-follow-similar"><img src="<%= similarItem.get('image') %>" title="<%= similarItem.get('name') %>" /></a>
      </div>
    <% }); %>
  </div>
</script>
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
<!--- Generial templates --->
<script type="text/template" id="krimi-wrapper-header">
  <div class="krimi-menu-header">
    <a>frem</a>
    <a>tilbage</a>
    <a>menu</a>
  </div>
</script>
<div id="krimi-dialog" title="Linked Data handlings boks" style="display:none;">
  <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>