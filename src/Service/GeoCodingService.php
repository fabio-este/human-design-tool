<?php

namespace App\Service;

/**
 * @copyright 2023 Fabio Stegmeyer <fabio.stegmeyer@gmail.com>
 * @license   Proprietary
 *
 * This Project can not be copied and/or distributed without the express
 * permission of Fabio Stegmeyer
 */

use Doctrine\Common\Collections\ArrayCollection;
use Geocoder\Model\Coordinates;
use Geocoder\Query\GeocodeQuery;
use Psr\Http\Client\ClientInterface;
use Geocoder\Provider\GoogleMaps\GoogleMaps;
use Geocoder\StatefulGeocoder;

/**
 * Class SendLogService
 *
 * @package App\Service\SendLogService
 */
class GeoCodingService
{
    /**
     * @var GoogleMaps
     */
    protected GoogleMaps $provider;

    /**
     * @var StatefulGeocoder
     */
    protected StatefulGeocoder $geocoder;

    /**
     * 
     * 
     * @todo: use api key from config
     *
     * @param ClientInterface $httpClient
     */
    public function __construct(ClientInterface $httpClient)
    {
        $this->provider = new \Geocoder\Provider\GoogleMaps\GoogleMaps($httpClient, null, 'AIzaSyC7ZhrKuGD9_ueRN-jAyzfj-KH1_fPv6eI');
        $this->geocoder = new \Geocoder\StatefulGeocoder($this->provider, 'en');
    }

    /**
     * Undocumented function
     *
     * @param [type] $address
     * @return void
     */
    public function geocode(string $address): ?Coordinates
    {
        $result = $this->geocoder->geocodeQuery(GeocodeQuery::create($address));


        if (!$result->isEmpty()) {
            $firstResult = $result->first();
            return $firstResult->getCoordinates();
        }
        return NULL;
    }
}
