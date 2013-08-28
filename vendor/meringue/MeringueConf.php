<?php 
/**
 * Meringue micro-framework
 * 
 * @author Jean THOMAS <contact@tibounise.com>
 */

Meringue::set('callback.render',['meringue\template\Render','render']);
Meringue::set('callback.notFound',null);
Meringue::set('callback.saltGenerator',['meringue\security\Crypto','OpenSSLSaltGenerator']);
Meringue::set('callback.tokenGenerator',['meringue\security\Crypto','basicTokenGenerator']);
Meringue::set('callback.hashGenerator',['meringue\security\Crypto','cryptHashGenerator']);

?>