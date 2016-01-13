<?php
use System\Router;

Router::get( "", "Index@index" );
Router::get( "airforces", "Index@airforces" );
Router::get( "ankieta", "Index@ankieta" );
Router::get( "ksiegagosci", "Index@ksiegagosci" );

Router::get( "user", "User@index" );

Router::get( "user/login", "User@login" );
Router::post( "user/login", "User@postLogin" );

Router::get( "user/login/{abc}", "User@login" );

Router::get( "user/register", "User@register" );
Router::post( "user/register", "User@postRegister" );

Router::get( "user/logout", "User@logout" );

Router::get( "photos", "Photos@index" );
Router::get( "photos/remembered", "Photos@rememberedPhotos" );
Router::get( "photos/search", "Photos@searchPhotos" );

Router::get( "photos/add", "Photos@addPhoto");
Router::post( "photos/add", "Photos@postAddPhoto");
Router::post( "photos/remember", "Photos@postRememberPhotos");
Router::post( "photos/forget", "Photos@postForgetPhotos");

Router::get('ajax/searchPhotos/{text}', "Ajax@searchPhotos");