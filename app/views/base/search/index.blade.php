
<div class="row">
  <div class="span12">
    <div class="categories-menu rounded" style="overflow: auto; display: none;">
      <div>
      КАТАЛОГ
      </div>
    </div>
    <div class="rounded white sticker" style="margin-bottom: 10px;" id="exp-sort-panel">
        <div class="rwrapper">
          <div class="btn-group">
            <button class="btn btn-rounded">по цене</button>
            <button class="btn btn-rounded">по рейтингу</button>
          </div>
          <input type="text" id="search-input">
          <div class="btn-group">
            <input type="submit" class="button button-rounded button-flat-caution" onclick="App.loadProducts()" value="Искать">
          </div>
        </div>
    </div>
    <div id="exp-result-content"></div>
  </div>
</div>


<script>

    $(document).ready(function(){
        $(".sticker").sticky({topSpacing: 41, bottomSpacing: 50});
    });
    
    function retov(){
        $('#exp-hotel-info').fadeOut(400, function(){
            $('#exp-sort-panel-sticky-wrapper').fadeIn(400);
            $('#exp-search-result').fadeIn(400);
            delete $.template["tpl-hotel-info"];
            $('#exp-hotel-info').remove(); 
        });
        
        $('#search-filter').slideDown(400);
        $('#retov-button').fadeOut(200);
        $('#hotel-info-menu').slideUp(400);
    }
    
    function scrollToRooms(){
        $.scrollTo($('#exp-hotel-info .rooms-container'), 800);
    }

</script>

@include('base.templates')
