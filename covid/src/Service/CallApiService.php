<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private HttpClientInterface $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Return an array of CORANAVIRUS french datas
     *
     * @return array
     */
    public function getFranceData(): array
    {
        return $this->getApi('FranceLiveGlobalData');
    }

    /**
     * Return an array of CORANAVIRUS french departments datas
     * @return array
     */
    public function getAllData(): array
    {
        return $this->getApi('AllLiveData');
    }

    /**
     * Return an array of one CORANAVIRUS french department datas
     * @param string $department
     * @return array
     */
    public function getDepartmentData(string $department): array
    {
        return $this->getApi('LiveDataByDepartement?Departement=' .$department);
    }

    /**
     * Return an array of CORANAVIRUS french department datas for a specific date
     * @return array
     */
    public function getAllDataByDate($date): array
    {
        // https://coronavirusapi-france.now.sh/AllDataByDate?date={date}
        return $this->getApi('AllDataByDate?date=' .$date);
    }

    /**
     * Get the content of a GET request to an API
     *
     * @param string $var Argument to the URI to complete the contact of the API
     * @return array
     */
    private function getApi(string $var): array
    {
        $response = $this->client->request(
            'GET',
            'http://coronavirusapi-france.now.sh/' . $var,
        );

        return $response->toArray();
    }
}
