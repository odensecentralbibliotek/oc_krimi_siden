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
    width:150px;
}
.oc-krimi-menu
{
    margin: 10px;
}
</style>
<div class="krimi-wrapper">
    <div id="oc_krimi_menu"></div>
    <div id="oc_krimi_app">
        
    </div>
</div>

<script type="text/template" id="krimi-main-menu">
  <div class="view">
  <a id="krimi_similar_books_button"><div id="oc_krimi_top_1" class="Linked_data_button"><div><img  src="<?php echo "/".drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" /></div><div>Lignende Forfattere</div></div></a>
   <a id="krimi_genre_view_button"> <div id="oc_krimi_top_3" class="Linked_data_button"><div><img  src="<?php echo "/".drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" /></div><div >lignende Genre</div></div></a>
    <div id="oc_krimi_top_4" class="Linked_data_button"><div><img  src="<?php echo "/".drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" /></div><div>lignende Steder?</div></div>
    <div id="oc_krimi_top_4" class="Linked_data_button"><div><img  src="<?php echo "/".drupal_get_path('module', 'oc_krimi_siden') . "/images/hcandersen.png"; ?>" /></div><div>Samme Hovedeperson?</div></div>
   </div>
</script>
<!--- view: Genre selection --->
<script type="text/template" id="krimi-genre-similar-books">
  <div class="krimi_similar_view">
   <h2>Bøger i Genre</h2>
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
<!--- book genres -->
<script type="text/template" id="krimi-books-genre">
<div> 
<h2>Lignende genrer</h2>
<a id="krimi_goto_menu_btn"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
</div>
<div>

 <% _.each(genres.models, function(genre) { %>
 <a id="<%= genre.get('identifier').value %>" class="krimi-follow-similar-genre"><img src="<%= genre.get('genre_billede').value %>" /><%= genre.get('label').value %></a><br/>
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
 <a id="<%= author.get('author').value %>" class="krimi-follow-author-in-genre"><img class="krimi-author-profile-image" src="default.jpg" /><%= author.get('author').value %></a><br/>
<% }); %>
</div>
</script>
<!---end -->
<div id="krimi-dialog" title="Linked Data handlings boks" style="display:none;">
  <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
</div>