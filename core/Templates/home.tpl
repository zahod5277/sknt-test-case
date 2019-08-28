<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&display=swap&subset=cyrillic" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="stylesheet" href="/assets/template/styles/app.min.css"/>
        <title>{$pagetitle}</title>
    </head>
    <body>
        <div class="flex-container tarifs-group" data-select-parent="group">
            {foreach $JSON as $data}
                <div class="tarifs-group__item">
                    <div class="tarifs-group__item-title heading">
                        <h3>{$data.title}</h3>
                    </div>
                    <a class="tarifs-group__item-info flex-container" href="#" data-action="GetTarifs" data-select="group" data-group="{$data['title']}">
                        <div class="tarifs-group__item-wrapper data__item">
                            <div class="tarifs-group__item-speed-outer">
                                <span class="tarifs-group__item-speed tarifs-group__item-speed--{$data['class']}">
                                    {$data['speed']} Мбит/с
                                </span>
                            </div>
                            <div class="tarifs-group__item-price price">
                                {$data['min_price']} - {$data['max_price']} ₽/мес
                            </div>
                            <div class="tarifs-group__item-options text">
                                {if $data['options']?}
                                    {$data['options']|join:', '}
                                {/if}
                            </div>
                        </div>
                        <div class="tarifs-group__item-wrapper data__arrow">
                            <div class="tarifs-group__item-more">
                                <i class="arrow arrow--right"></i>
                            </div>
                        </div>
                    </a>
                    <div class="tarifs-group__item-link">
                        <a href="{$data['link']}" target="_blank">Узнать подробнее на сайте www.sknt.ru</a>
                    </div>
                </div>
            {/foreach}
        </div>
        <div class="tarifs" data-select-parent="GetTarifs">

        </div>
        <div class="tarif" data-select-parent="GetTarif">

        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
        <script src="/assets/template/scripts/main.min.js"></script>
    </body>
</html>