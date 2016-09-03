<?php

use App\Entity\Meetup;
use App\Entity\Talk;
use App\Entity\Schedule;

$etitle = 'PHP Hampshire - April 2016 Meetup';
$eid = '22224261364';
$eventbriteWidget = '<div style="width:100%; text-align:left; padding-top: 20px" >';
$eventbriteWidget .= '<iframe  src="https://www.eventbrite.co.uk/tickets-external?eid=' . $eid . '&ref=etckt&v=2" frameborder="0" height="240" width="100%" vspace="0" hspace="0" marginheight="5" marginwidth="5" scrolling="auto" allowtransparency="true"></iframe>';
$eventbriteWidget .= '<div style="font-family:Helvetica, Arial; font-size:10px; padding:5px 0 5px; margin:2px; width:100%; text-align:left;" >';
$eventbriteWidget .= '<a style="color:#888; text-decoration:none;" target="_blank" href="https://www.eventbrite.co.uk/r/etckt">Event Registration Online</a>';
$eventbriteWidget .= '<span style="color:#888;"> for </span>';
$eventbriteWidget .= '<a style="color:#888; text-decoration:none;" target="_blank" href="https://www.eventbrite.co.uk/event/' . $eid . '?ref=etckt">' . $etitle . '</a>';
$eventbriteWidget .= '<span style="color:#888;"> powered by </span>';
$eventbriteWidget .= '<a style="color:#888; text-decoration:none;" target="_blank" href="https://www.eventbrite.co.uk?ref=etckt">Eventbrite</a>';
$eventbriteWidget .= '</div></div>';

$meetup = new Meetup();

$abstract = <<<END
This talk starts with a comparison of the different practices and tools we can use in the PHP ecosystem and is followed by a continuousphp demo, so that viewers can see a demo app tested and deployed in real time, with all the practices and tools explained before.
END;

$meetup->setId(0)
    ->setFromDate(new DateTimeImmutable('2016-04-13 19:00'))
    ->setToDate(new DateTimeImmutable('2016-04-13 23:00'))
    ->setRegistrationUrl("https://www.eventbrite.co.uk/event/{$eid}")
    ->setLocationUrl("https://www.google.co.uk/maps?q=Oasis+Venue,+Arundel+Street,+PO1+1NP&hl=en&ll=50.799642,-1.086724&spn=0.011772,0.031629&sll=50.799734,-1.086874&sspn=0.011772,0.031629&hq=Oasis+Venue,&hnear=Arundel+St,+PO1+1NP,+United+Kingdom&t=m&z=16")
    ->setLocation('Oasis the Venue, Arundel Street, PO1 1NP')
    ->setTalkingPoints(array(
    	new Talk('Mike Rogers', 'MikeRogers0', '5 minute lightning talk'),
    	new Talk('Frederic Dewinne', 'fdewinne', 'The Continuous Talk', $abstract),
        '&pound;20 Amazon.co.uk gift voucher prize draw, courtesy of Spectrum IT',
		'A year PhpStorm license prize, courtesy of JetBrains',
    ))
	->setSchedule(array(
		new Schedule(new \DateTimeImmutable('19:00'), 'Arrival with beer and pizza'),
		new Schedule(new \DateTimeImmutable('19:25'), 'Welcome announcement'),
		new Schedule(new \DateTimeImmutable('19:30'), 'Mike Rogers'),
		new Schedule(new \DateTimeImmutable('19:40'), 'Frederic Dewinne'),
		new Schedule(new \DateTimeImmutable('20:40'), 'Closing comments'),
		new Schedule(new \DateTimeImmutable('20:45'), 'Social gathering at <a href="http://brewhouseandkitchen.com/portsmouth">Brewhouse Pompey</a> (The White Swan)'),
	))
    ->setWidget($eventbriteWidget);

return $meetup;
