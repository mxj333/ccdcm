<?php foreach ($articles as $article): ?>
    <div class="row country-item">
        <div class="col-xs-6 col-md-3">
            <a href="/articles/view/<?= $article->id?>/<?= $article->art_url_alias?>.html">
                <img src="<?= getCover($article)?>" alt="<?= h($article->art_title) ?>">
            </a>
        </div>
        <div class="col-xs-6 col-md-9">
            <h5>
                <a href="/articles/view/<?= $article->id?>/<?= $article->art_url_alias?>.html"> 
                <?php
                    if (is_mobile()) {
                        echo getShortTitle($article->art_title, 18);
                    } else {
                        echo $article->art_title;
                    }
                ?>
                </a>
            </h5>
            <?php
                if (is_mobile()) {
                    echo getShortTitle($article->art_body, 18);
                } else {
                    echo getShortTitle($article->art_body, 100);
                }
            ?>
        </div>
    </div>
    <!-- <hr> -->
<?php endforeach; ?>