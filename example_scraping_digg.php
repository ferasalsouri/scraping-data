<?php
include_once('simple_html_dom.php');

function scraping_digg()
{
    // create HTML DOM
    $html = file_get_html('https://www.maannews.net/');

    // get news block


    foreach ($html->find('a.featured-3__second__item ') as $article) {


        // get title
        $item['title'] = trim($article->find('div.featured-3__second__title', 0)->plaintext);
//        // get details
        $item['details'] = '';
        // get image

        $item['image'] = trim($article->find('div.featured-3__second__image img', 0));

        $ret[] = $item;
    }
    foreach ($html->find('a.list-2__item') as $article) {


        // get title
        $item['title'] = trim($article->find('span.list-2__title', 0)->plaintext);
//        // get details
        $item['details'] = trim($article->find('span.list-2__content', 0)->plaintext);
        // get image
        $item['image'] = trim($article->find('span.list-2__image img', 0));

        $ret[] = $item;
    }
    foreach ($html->find('div.list-3 a') as $article) {


        // get title
        $item['title'] = trim($article->find('span.list-3__title', 0)->plaintext);
//        // get details
        $item['details'] = '';
        // get image
        $item['image'] = trim($article->find('span.list-3__image img', 0));

        $ret[] = $item;
    }


    // clean up memory
    $html->clear();
    unset($html);

    return $ret;
}


// -----------------------------------------------------------------------------
// test it!

// "http://digg.com" will check user_agent header...
ini_set('user_agent', 'My-Application/2.5');

$ret = scraping_digg();
print_r($ret);
