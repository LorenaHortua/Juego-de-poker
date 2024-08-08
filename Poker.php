<?php

// Función para repartir 5 cartas aleatorias
function repartirCartas() {
    $mazo = [
        '♥' => ["As", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"],
        '♦' => ["As", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"],
        '♣' => ["As", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"],
        '♠' => ["As", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"],
    ];

    $cartas = [];
    foreach ($mazo as $palo => $numeros) {
        foreach ($numeros as $numero) {
            $cartas[] = $numero . ' de ' . $palo;
        }
    }

    //barajar cartas 
    shuffle($cartas); 
    //Devolver 5 cartas aleatorias
    return array_slice($cartas, 0, 5); 
}

// Función para mostrar las cartas
function mostrarCartas($cartas) {
    foreach ($cartas as $carta) {
        echo $carta . "\n";
    }
}

// Función para evaluar la mano
function evaluarMano($cartas) {
    $paloCount = [];
    $numeroCount = [];

    foreach ($cartas as $carta) {
        list($numero, $palo) = explode(' de ', $carta);
        $paloCount[$palo][] = $numero;
        $numeroCount[$numero][] = $palo;
    }

    $esColor = count($paloCount) === 1;

    $numerosOrden = ['2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K', 'As'];
    $indices = array_map(function($numero) use ($numerosOrden) {
        return array_search($numero, $numerosOrden);
    }, array_keys($numeroCount));

    sort($indices);
    $esEscalera = ($indices === range(min($indices), max($indices)));

    if ($esColor && $esEscalera) {
        // Escalera Real
        if ($indices === [8, 9, 10, 11, 12]) { 
            echo "Escalera Real\n";
        } else {
            echo "Escalera de Color\n";
        }
    } elseif (max(array_map('count', $numeroCount)) === 4) {
        echo "Póker\n";
    } elseif (max(array_map('count', $numeroCount)) === 3 && in_array(2, array_map('count', $numeroCount))) {
        echo "Full House\n";
    } elseif ($esColor) {
        echo "Color\n";
    } elseif ($esEscalera) {
        echo "Escalera\n";
    } elseif (max(array_map('count', $numeroCount)) === 3) {
        echo "Trío\n";
    } elseif (count(array_filter(array_map('count', $numeroCount), function($x) { return $x === 2; })) === 2) {
        echo "Doble Pareja\n";
    } elseif (max(array_map('count', $numeroCount)) === 2) {
        echo "Pareja\n";
    } else {
        echo "Carta Alta\n";
    }
}

// Programa principal
$cartas = repartirCartas();
echo "Cartas repartidas:\n";
mostrarCartas($cartas);
echo "Mejor combinación:\n";
evaluarMano($cartas);

?>