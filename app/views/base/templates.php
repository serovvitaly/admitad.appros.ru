<script id="tpl-product-item-mini" type="text/x-handlebars-template">
<div class="sri-box rounded white" style="display:none"><div class="rwrapper">
    <div class="image"><img class="crop" alt="" src="{{picture}}"></div>
    <div>
      <div class="name">{{name}}</div>
      <div>{{advcampaign.name}}</div>
      <div class="note">{{description}}</div>
      <div class="price"><span>{{price}} <sup>{{currencyId}}</sup></span></div>     
    </div>
    <div class="controls">
      {{#if delivery}}доставка{{/if}}
    </div>
</div></div>
</script>

<script id="tpl-product-popup" type="text/x-handlebars-template">
<div class="rounded white">
  <div class="rwrapper">
      <div class="row-fluid">
        <div class="span6">
          <div class="galleria" style="height: 680px; border: 1px solid #D0D0D0">
            {{#each  picture_orig}}<img src="{{this}}" data-title="My title" data-description="My description">{{/each}}
          </div>
        </div>
        <div class="span6">
          <h1 class="title" style="font-weight: 300; margin: 0; font-size: 22px;">{{name}}</h1>
          <p>{{model}}</p>
          <p>{{typePrefix}}</p>
          <p>{{param}}</p>
          <div class="description-box" style="line-height: 17px; color: #808080; margin-bottom: 20px;">
            {{description}}
          </div>
          
          <a href="#" class="button button-rounded button-flat-primary">{{price}} <sup>{{currencyId}}</sup></a>
          
          {{#if delivery}}<p>доставка</p>{{/if}}
          
          <p>{{vendor.name}}</p>
          <p>{{advcampaign.name}}</p>
          
        </div>
      </div>
  </div>

</div>
</script>
          
<script id="tpl-book-form" type="text/x-jquery-tmpl">
<div id="exp-book-form" class="rounded white" style="display:none"><div class="rwrapper">
  <h3 style="margin:0">Бронирование <a href="#" onclick="return false;" class="button-return" style="font-size:12px;font-weight: normal;padding-left:18px">вернуться к описание отеля</a></h3>
  <div style="height:20px"></div>
  <table>
    <tr><td>За проживание:</td><td>${commissionableUsdTotal} ${currencyCode}</td></tr>
    <tr><td>Налоги и сборы:</td><td>${surchargeTotal} ${currencyCode}</td></tr>
    <tr><td><strong>К оплате:</strong></td><td>${chargeableRate} ${currencyCode}</td></tr>
  </table>
  <form class="form-horizontal" method="POST" action="/expedia/book" style="margin-top:40px">
    <input type="hidden" name="hotelId" value="${hotelId}">
    <input type="hidden" name="arrivalDate" value="${arrivalDate}">
    <input type="hidden" name="departureDate" value="${departureDate}">
    <input type="hidden" name="supplierType" value="${supplierType}">
    <input type="hidden" name="rateKey" value="${rateKey}">
    <input type="hidden" name="roomTypeCode" value="${roomTypeCode}">
    <input type="hidden" name="rateCode" value="${rateCode}">
    <input type="hidden" name="chargeableRate" value="${chargeableRate}">
    <div class="control-group">
      <label class="control-label">Имя</label>
      <div class="controls">
        <input type="text" name="firstName" value="tester">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Фамилия</label>
      <div class="controls">
        <input type="text" name="lastName" value="testing">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Email</label>
      <div class="controls">
        <input type="text" name="email" value="test@yourSite.com">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Телефон</label>
      <div class="controls">
        <input type="text" name="homePhone" value="2145370159">
      </div>
    </div>
    
    <fieldset>
    <legend>Адрес</legend>
    
    <div class="control-group">
      <label class="control-label">Страна</label>
      <div class="controls">
        <input type="text" name="countryCode" style="width:50px" value="US">
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label">Город</label>
      <div class="controls">
        <input type="text" name="city" value="Bellevue">
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label">Индекс</label>
      <div class="controls">
        <input type="text" name="postalCode" value="98004">
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label">Адрес</label>
      <div class="controls">
        <input type="text" name="address1" value="travelnow">
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label">stateProvinceCode</label>
      <div class="controls">
        <input type="text" name="stateProvinceCode" value="WA">
      </div>
    </div>


        
    </fieldset>
    
    <fieldset>
    <legend>Карта</legend>
        
    <div class="control-group">
      <label class="control-label">Номер карты</label>
      <div class="controls">
        <input type="text" name="creditCardNumber" value="5401999999999999">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Тип карты</label>
      <div class="controls">
        <select name="creditCardType" style="width:auto">
          <option value="VI">Visa</option>
          <option value="AX">American Express</option>
          <option value="BC">BC Card</option>
          <option value="CA" selected="selected">MasterCard</option>
          <option value="CB">Carte Blanche</option>
          <option value="CU">China Union Pay</option>
          <option value="DS">Discover</option>
          <option value="DC">Diners Club</option>
          <option value="T">Carta Si</option>
          <option value="R">Carte Bleue</option>
          <option value="N">Dankort</option>
          <option value="L">Delta</option>
          <option value="E">Electron</option>
          <option value="JC">Japan Credit Bureau</option>
          <option value="TO">Maestro</option>
          <option value="S">Switch</option>  
        </select>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Защитный код</label>
      <div class="controls">
        <input type="text" name="creditCardIdentifier" style="width:50px" value="123">
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Годна до</label>
      <div class="controls">
        <input type="text" style="width:20px" name="creditCardExpirationMonth" value="11"> / <input type="text" style="width:40px" name="creditCardExpirationYear" value="2015">
      </div>
    </div>
        
    </fieldset>
    
    <div class="control-group">
      <div class="controls">
        <button type="submit" class="btn">Бронировать</button>
      </div>
    </div>
    
  </form>
  
</div></div>
</script>


<script id="tpl-hotel-room" type="text/x-jquery-tmpl">
<div class="hotel-room rwrapper">
  <div class="hr-sp-6">
    <strong>${roomTypeDescription}</strong>
    <div>Максимальная вместимость: ${quotedOccupancy}</div>
    <a href="#">подробнее</a>
  </div>
  <div class="hr-sp-2 hr-right hr-price">
    ${rateTotal} <sup>${currencyCode}</sup>
  </div>
  <div class="hr-sp-2 hr-right">
    <a href="#" onclick="return false;" class="button button-rounded button-flat-caution button-small">БРОНИРОВАТЬ</a>
  </div>
</div>
</script>

<script id="tpl-book-result" type="text/x-jquery-tmpl">
<div id="exp-book-result" class="rounded white" style="display:none"><div class="rwrapper">
  <p class="content" style="text-align:center">{{html content}}</p>
</div></div>
</script>

<script id="tpl-book-success" type="text/x-jquery-tmpl">
<div id="exp-book-success" style="display:none">
  <h4>Операция прошла успешно</h4>
  <p>Статус бронирования: <strong>${reservationStatusCode}</strong></p>
  <table>
    <tr><td>Идентификатор:</td><td>${itineraryId}</td></tr>
    <tr><td>Отель:</td><td>${hotelName}</td></tr>
    <tr><td>Адрес:</td><td>${hotelCity}, ${hotelAddress}</td></tr>
    <tr><td>Дата заезда:</td><td>${arrivalDate}</td></tr>
    <tr><td>Дата выезда:</td><td>${departureDate}</td></tr>
    <tr><td>Количество комнат:</td><td>${numberOfRoomsBooked}</td></tr>
    <tr><td>Человек в комнате:</td><td>${rateOccupancyPerRoom}</td></tr>
    <tr><td>Комната:</td><td>${roomDescription}</td></tr>
  </table>
</div>
</script>