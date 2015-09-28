<?php
require_once __DIR__.'/vendor/autoload.php';

$app = new Silex\Application(); $app['debug'] = true;

$app->register( new Silex\Provider\SwiftmailerServiceProvider() );
$app['swiftmailer.transport'] = Swift_SendmailTransport::newInstance('/usr/sbin/sendmail -bs');

$app->get( '/', function() {
	return 'Hello.';
} );

$app->post( '/feedback', function() use( $app ) {
	return ( new AttributionGenerator\Actions\FeedbackAction( $app ) )->getResponse();
} );

return $app;
