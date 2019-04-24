<?php

namespace App\Controller;

use App\Repository\EntityRepository;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use GuzzleHttp\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class GoogleCalendarController extends AbstractController
{
    /**
     * @Route("/google/calendar", name="google_calendar")
     * @throws \Google_Exception
     */
    public function getClient( EntityRepository $entityRepository, SessionInterface $session )
    {
        $entity = $entityRepository->findAll();



        $client = new \Google_Client();
        $client->setAuthConfig('../client_secret.json');
        $client->addScope(\Google_Service_Calendar::CALENDAR_EVENTS);

        $guzzleClient = new Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);

        if ($session->get('access_token')){
            $client->setAccessToken($session->get('access_token'));
            $service = new Google_Service_Calendar($client);

            $event = new Google_Service_Calendar_Event(array(
                'summary' => 'Test',
                'location' => '105 Avenue de la République, 59110 La Madeleine',
                'description' => 'Un test',
                'start' => array(
                    'dateTime' => '2019-04-23T18:00:00+01:00',
                    'timeZone' => 'Europe/Paris',
                ),
                'end' => array(
                    'dateTime' => '2019-04-23T20:00:00+01:00',
                    'timeZone' => 'Europe/Paris',
                ),
                'recurrence' => array(
                    'RRULE:FREQ=DAILY;COUNT=2'
                ),
                'attendees' => array(
                    array('email' => 'lpage@example.com'),
                    array('email' => 'sbrin@example.com'),
                ),
            ));

            $calendarId = 'primary';
            $service->events->insert($calendarId, $event);

        } else{
            return $this->redirectToRoute('oauth');
        }

        return $this->render('google_calendar/index.html.twig', [
            'controller_name' => 'GoogleCalendarController',
            'entitys' => $entity,

        ]);
    }

    /**
     * @Route("/oauth", name="oauth")
     * @throws \Google_Exception
     */
    public function oauth(Request $request, SessionInterface $session)
    {

        $rurl = $this->generateUrl('oauth', array(), false);
        $client = new \Google_Client();
        $client->setAuthConfigFile('../client_secret.json');
        $client->setRedirectUri($rurl); // redirection
        $client->addScope(\Google_Service_Calendar::CALENDAR_EVENTS);

        $guzzleClient = new Client(array('curl' => array(CURLOPT_SSL_VERIFYPEER => false)));
        $client->setHttpClient($guzzleClient);

        $code = $request->query->get('code');
        if (!$code) {
            $auth_url = $client->createAuthUrl();
            $filtered_url = filter_var($auth_url, FILTER_SANITIZE_URL);

            return $this->redirect($filtered_url);
        } else {
            $client->authenticate($code);
            $session->set('access_token', $client->getAccessToken());

            return $this->redirectToRoute('google_calendar');
        }
    }
}
