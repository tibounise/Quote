<?php

Meringue::load(__APPROOT__.'/src/');

Meringue::set('meringue.render.path',__APPROOT__.'/app/templates');

Meringue::route('/',['\\Quote\\Index\\Controller','pickRandomQuoteAction']);

?>