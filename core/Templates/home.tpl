<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

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
                        <div class="tarifs-group__item-wrapper">
                            <div class="tarifs-group__item-speed">
                                {$data['speed']} Мбит/с
                            </div>
                            <div class="tarifs-group__item-price">
                                {$data['min_price']} - {$data['max_price']} ₽/мес
                            </div>
                        </div>
                        <div class="tarifs-group__item-wrapper">
                            <div class="tarifs-group__item-more">

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