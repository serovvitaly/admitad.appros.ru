
<div class="row">
  <div class="span12">
    <div class="categories-menu rounded" style="overflow: auto;">
      <div>
      <? 
          $level_1 = '';
          foreach ($categories AS $category) {
              if (!isset($category['parent'])) {
                  $level_1 .= '<div class="category-box"><strong>'.$category['name'].'('.$category['id'].')</strong></div>';
              }
          } 
      ?>
      <?= $level_1 ?>
      </div>
    </div>
    <div class="rounded white sticker" style="margin-bottom: 10px;" id="exp-sort-panel">
        <div class="rwrapper">
          <div class="btn-group">
            <input type="submit" class="button button-rounded" value="Категории">
            <input type="submit" class="button button-rounded button-flat-caution" onclick="App.loadProducts()" value="Найти одежду">
          </div>
          <div class="btn-group">
            <button class="btn btn-mini">по цене</button>
            <button class="btn btn-mini">по рейтингу</button>
            <button class="btn btn-mini">по звездности</button>
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
    
    function loadHotelInfo(options){
        var fields = $.extend({
            //
        }, options);
        
        delete $.template["tpl-hotel-info"];
        $('#exp-hotel-info').remove();
        
        $('#exp-sort-panel-sticky-wrapper').fadeOut(400);
        $('#exp-search-result').fadeOut(400, function(){
            $('<div class="loader ajax-loader"></div>').prependTo('#exp-result-content').fadeIn(400);
        });
        
        $.ajax({
            url: 'http://api.appros/expedia/hotel-info',
            dataType: 'jsonp',
            type: 'POST',
            data: fields,
            success: function(data){
                //console.log(data);
                if (data.errors && data.errors.length > 0) {
                    $('#exp-result-content .loader').html('');
                    $.each(data.errors, function(index, item){
                        $('#exp-result-content .loader').html('<p>' + item.message + '</p>');
                    });
                    return;
                }
                if (data.result) {
                    $('#exp-result-content .loader').fadeOut(100, function(){});
                    //data.result.checkInInstructions = htmlspecialchars_decode(data.result.checkInInstructions);
                    $.tmpl($('#tpl-hotel-info').html().trim(), data.result).appendTo('#exp-result-content');

                    $('#exp-hotel-info .room-item a.book').click(function(){
                        var item = $(this);
                        $('#exp-hotel-info').fadeOut(200, function(){
                            $.tmpl($('#tpl-book-form').html().trim(), {
                                hotelId: data.result.HotelSummary.hotelId,
                                arrivalDate: data.result.HotelRoomAvailabilityResponse.arrivalDate,
                                departureDate: data.result.HotelRoomAvailabilityResponse.departureDate,
                                supplierType: item.attr('data-suppliertype'),
                                rateKey: item.attr('data-ratekey'),
                                roomTypeCode: item.attr('data-roomtypecode'),
                                rateCode: item.attr('data-ratecode'),
                                currencyCode: item.attr('data-currencycode'),
                                commissionableUsdTotal: item.attr('data-commissionableusdtotal'),
                                surchargeTotal: item.attr('data-surchargetotal'),
                                chargeableRate: item.attr('data-chargeablerate')
                            }).appendTo('#exp-result-content');
                            $('#exp-book-form .button-return').click(function(){
                                $('#exp-book-form').fadeOut(200, function(){
                                    $('#exp-hotel-info').fadeIn(200);
                                    $('body,html').animate({scrollTop: 0}, 200);
                                    $('#exp-book-form').remove();
                                });
                            });
                            $('#exp-book-form form').ajaxForm({
                                dataType: 'json',
                                beforeSubmit: function($formData, jqForm, options){
                                    $('#exp-book-form').fadeOut(200, function(){
                                        $.tmpl($('#tpl-book-result').html().trim(), {
                                            content: '<h3>Бронируем комнату...</h3>'
                                        }).appendTo('#exp-result-content');
                                        $('#exp-book-result').fadeIn(200);
                                    });
                                },
                                success:  function(data, statusText, xhr, $form){
                                    
                                    if (data.errors && data.errors.length > 0) {
                                        $('#exp-book-result .content').html('');
                                        $.each(data.errors, function(index, item){
                                            $('#exp-book-result .content').append('<p style="text-align:center">'+item.message+'</p>');
                                        });
                                        return;
                                    }
                                    
                                    if (data.success == true && data.result.itineraryId && data.result.itineraryId > 0) {
                                        $('#exp-book-result').fadeOut(200, function(){
                                            $.tmpl($('#tpl-book-success').html().trim(), data.result).appendTo('#exp-result-content');
                                            $('#exp-book-success').fadeIn(200, function(){
                                                $('#exp-book-result').remove();
                                            });
                                        });
                                    } else {
                                        $('#exp-book-result .content').html('<strong style="color:red">Не удалось забронировать</strong>');
                                    }
                                }
                            });
                            $('#exp-book-form').fadeIn(200);
                            $('body,html').animate({scrollTop: 0}, 200);
                        });
                    });
                  /*  $('#exp-hotel-info').fadeIn(400, function(){
                        $('body,html').animate({scrollTop: 0}, 400);
                    });*/
                        
                    
                    $('#retov-button').fadeIn(200);
                    $('#search-filter').slideUp(400);
                    
                    $('#hotel-info-menu').slideDown(400, null, function(){
                        
                        $('#exp-hotel-info .rooms-container').html('');
                        $.ajax({
                            url: 'http://api.appros/expedia/room-availability',
                            dataType: 'jsonp',
                            data: {
                                hotelId:       fields.hotelId,
                                arrivalDate:   fields.arrivalDate,
                                departureDate: fields.departureDate
                            },
                            success: function(data){
                                
                                console.log(data);
                                
                                if (data.success) {
                                    if (data.result.items.length > 0) {
                                        $.each(data.result.items, function(index, item){
                                            $.tmpl($('#tpl-hotel-room').html().trim(), item).appendTo('#exp-hotel-info .rooms-container');
                                        });
                                    }
                                }
                            }
                        });
                         
                        $('#exp-hotel-info').fadeIn(400, function(){
                            
                            if (data.result.images.length > 0) {
                                Galleria.loadTheme('packages/jquery/galleria/themes/classic/galleria.classic.min.js');
                                Galleria.run('#hotel-galleria', {
                                    transition: 'fade',
                                    imageCrop: true,
                                    width: 404,
                                    height: 320 
                                });
                                
                                $('#hotel-galleria').fadeIn(400);    
                            }
                            
                            $('body,html').animate({scrollTop: 0}, 400);
                        });    
                        
                    });
                    
                    
                }
            }
        });
    }


</script>

@include('base.templates')
