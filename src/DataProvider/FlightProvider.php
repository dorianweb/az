<?php

 //revoir plus tard apres le test + data persister + stateprovider 

// use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
// use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
// use App\Entity\Flight;
// use App\Repository\FlightRepository;


// final class FlightProvider implements RestrictedDataProviderInterface, ContextAwareCollectionDataProviderInterface
// {

//     public function __construct(private FlightRepository $repo)
//     {
//     }

//     public function getCollection(string $resourceClass, string $operationName, $context = []): iterable
//     {
//         if (isset($context['filters']) && !empty($context['filters']['page'])) {
//             $page = (int) $context['filters']['page'];
//         } else {
//             $page = 1;
//         }
//         return $this->repo->getFlights($page);
//     }
//     public function supports(string $resourceClass, string $operationName, $context = [])
//     {
//         return $resourceClass === Flight::class;
//     }
// } 
