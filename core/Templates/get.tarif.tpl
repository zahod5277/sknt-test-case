<div class="tarifs__heading">
    <a href="#" class="tarifs__heading-backward" data-backward="GetTarifs">
        <i class="arrow arrow--left arrow--green"></i>
    </a>
    <h3 class="tarifs__heading-text">Выбор тарифа</h3>
</div>
<div class="tarifs__outer">
    <div class="tarifs__item">
        <h3 class="heading heading--border">Тариф {$JSON['title']}</h3>
        <div class="data flex-container">
            <div class="data__item data__item--widest">
                <div class="price">
                    <span>{$JSON.price} ₽/мес</span>
                </div>
                <div class="text text--margined">
                    {if $JSON.payment != $JSON.price}
                        <p>Разовый платёж - {$JSON.payment} ₽</p>
                        <p>Со счёта спишется - {$JSON.payment} ₽</p>
                    {else}
                        <p>Разовый платёж - {$JSON.price} ₽</p>    
                        <p>Со счёта спишется - {$JSON.price} ₽</p>
                    {/if}
                </div>
                <div class="text text--light text--border-separated">
                    <p>Вступит в силу - сегодня</p>
                    <p>Активно до: {$JSON.payday}</p>
                </div>
                <button class="btn btn--default" onclick="alert('Спасибо, мы вам перезвоним и всё подключим.')">Выбрать</button>
            </div>
        </div>
    </div>
</div>