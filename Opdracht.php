<?php
//function dijkstra($graph, $startPoint, $endPoint) {
//    // Implementeer hier het Dijkstra's algoritme
//}

define('INFINITY', PHP_INT_MAX);

class MinPriorityQueue extends SPLPriorityQueue {

    public function compare($a, $b) {

        return parent::compare($b, $a); //inverse the order

    }

}

/**

 * Receives an array representing the graph and the initial vertex to calculate the smallest path

 * @param array $graph an array where the keys are the vertices of the graph and the values are

 * other arrays to represent the adjencies, with the other vertex as key and the weight as value

 * e.g.:  array( 'a' => array('b'=>0.7, 'c'=>'2'), 'b' => array('c'=> 0.5), 'c' => array('a'=> 0.2, 'b' => 1));

 */

function dijkstra(array $graph, $startPoint, $endPoint)  {

    $distance = array();


    foreach (array_keys($graph) as $v) {

        $distance[$v]  = INFINITY;

    }


    $distance[$startPoint] = 0;


    $nonOptimizedVertices = new MinPriorityQueue();

    $nonOptimizedVertices->insert($startPoint, $distance[$startPoint]);


    while(!$nonOptimizedVertices->isEmpty()) {

        $u = $nonOptimizedVertices->extract();

        if ($distance[$u] == INFINITY) {

            return false; //All the other elements are inacessible

        }

        foreach($graph[$u] as $neighbor => $edgeWeight) {

            $newDistance = $distance[$u] + $edgeWeight;

            if ($newDistance < $distance[$neighbor]) {

                $distance[$neighbor] = $newDistance;

                $nonOptimizedVertices->insert($neighbor,$distance[$neighbor]);

                var_dump($nonOptimizedVertices);

            }
        }
    }

    return $distance[$endPoint];

}


$graph = [
    'A' => [
        'B' => 10,
        'C' => 15
    ],
    'B' => [
        'A' => 10,
        'C' => 8
    ],
    'C' => [
        'A' => 15,
        'B' => 8,
        'D' => 12,
        'F' => 9
    ],
    'D' => [
        'C' => 12
    ],
    'E' => [
        'F' => 7
    ],
    'F' => [
        'E' => 7,
        'C' => 9
    ]
];


$startPoint = 'A';
$endPoint = 'E';

// Roep de dijkstra functie aan om de kortste looproute te vinden

var_dump(dijkstra($graph, $startPoint, $endPoint));
