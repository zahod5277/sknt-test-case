<div class="tarifs__heading">
    <div class="tarifs__heading-backward">
        <i class="arrow arrow--left arrow--green"></i>
    </div>
    <h3 class="tarifs__heading-text">Выбор тарифа</h3>
</div>
<div class="tarifs__outer">
    <div class="tarifs__item">
        <h3 class="heading heading--border">Тариф {$JSON['title']}</h3>
        <div class="data flex-container">
            <div class="data__item">
                <div class="price">
                    <span>{$JSON.price} ₽/мес</span>
                </div>
                <div class="text">
                    {if $JSON.payment != $JSON.price}
                        <p>Разовый платёж - {$JSON.payment} ₽</p>
                    {else}
                        <p>Разовый платёж - {$JSON.price} ₽</p>    
                    {/if}
                </div>
                <button class="btn" onclick="alert('Спасибо, мы вам перезвоним и всё подключим.')">Выбрать</button>
            </div>
        </div>
    </div>
</div>