<?

$routes = array();

$routes['GET']['/'] = 'PagesController@index';
$routes['POST']['/create'] = 'PagesController@create';

$routes['GET']['/about'] = 'PagesController@about';
$routes['GET']['/contacts'] = 'PagesController@contacts';

$routes['GET']['/404'] = 'ErrorsController@not_found';
