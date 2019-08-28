<div class="tarifs__heading">
    <a href="#" class="tarifs__heading-backward" data-backward="group">
        <i class="arrow arrow--left arrow--green"></i>
    </a>
    <h3 class="tarifs__heading-text">Тариф {$JSON['title']}</h3>
</div>
<div class="tarifs__outer flex-container">
    {foreach $JSON.tarifs as $data}
        <a class="tarifs__item" href="#" data-id="{$data.id}" data-action="GetTarif" data-select="tarif" data-group="{$JSON['title']}">
            <h3 class="heading heading--border">{$data.period} месяц</h3>
            <div class="data flex-container">
                <div class="data__item">
                    <div class="price">
                        <span>{$data.price} ₽/мес</span>
                    </div>
                    <div class="text">
                        {if $data.payment != $data.price}
                            <p>Разовый платёж - {$data.payment} ₽</p>
                            {else}
                            <p>Разовый платёж - {$data.price} ₽</p>    
                        {/if}
                        {if $data.discount != 0}
                            <p>Скидка - {$data.discount} ₽</p>
                        {/if}
                    </div>
                </div>
                <div class="data__arrow">
                    <div class="tarifs-group__item-more">
                        <i class="arrow arrow--right"></i>
                    </div>
                </div>
            </div>
        </a>
    {/foreach}
</div>
