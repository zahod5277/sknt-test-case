<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&display=swap&subset=cyrillic" rel="stylesheet">
        <link rel="stylesheet" href="/assets/template/styles/app.min.css"/>
        <title>{$pagetitle}</title>
    </head>
    <body>
        <h1>{$title}</h1>
        <div class="tarifs-group">
            {foreach $JSON as $data}
                <div class="tarifs-group__item">
                    <div class="tarifs-group__item-title">
                        <h3>{$data.title}</h3>
                    </div>
                    <div class="tarifs-group__item-info">
                        <div class="tarifs-group__item-wrapper tarifs-group__item-info-inner">
                            <div class="tarifs-group__item-speed-outer">
                                <span class="tarifs-group__item-speed tarifs-group__item-speed--{$data['class']}">
                                    {$data['speed']} Мбит/с
                                </span>
                            </div>
                            <div class="tarifs-group__item-price">
                                {$data['min_price']} - {$data['max_price']} ₽/мес
                            </div>
                            <div class="tarifs-group__item-options">
                                {if $data['options']?}
                                    {$data['options']|join:', '}
                                {/if}
                            </div>
                        </div>
                        <div class="tarifs-group__item-wrapper tarifs-group__item-info-arrow">
                            <div class="tarifs-group__item-more">
                                <i class="arrow arrow--right"></i>
                            </div>
                        </div>
                    </div>
                    <div class="tarifs-group__item-link">
                        <a href="{$data['link']}" target="_blank">Узнать подробнее на сайте www.sknt.ru</a>
                    </div>
                </div>
            {/foreach}
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
        <script src="/assets/template/js/app.js"></script>
    </body>
</html>