<?php

// Función para repartir 5 cartas aleatorias
function repartirCartas() {
    $mazo = [
        "As de Corazones", "2 de Corazones", "3 de Corazones", "4 de Corazones", "5 de Corazones", 
        "6 de Corazones", "7 de Corazones", "8 de Corazones", "9 de Corazones", "10 de Corazones", 
        "Jota de Corazones", "Reina de Corazones", "Rey de Corazones",
        "As de Picas", "2 de Picas", "3 de Picas", "4 de Picas", "5 de Picas", 
        "6 de Picas", "7 de Picas", "8 de Picas", "9 de Picas", "10 de Picas", 
        "Jota de Picas", "Reina de Picas", "Rey de Picas",
        "As de Tréboles", "2 de Tréboles", "3 de Tréboles", "4 de Tréboles", "5 de Tréboles", 
        "6 de Tréboles", "7 de Tréboles", "8 de Tréboles", "9 de Tréboles", "10 de Tréboles", 
        "Jota de Tréboles", "Reina de Tréboles", "Rey de Tréboles",
        "As de Diamantes", "2 de Diamantes", "3 de Diamantes", "4 de Diamantes", "5 de Diamantes", 
        "6 de Diamantes", "7 de Diamantes", "8 de Diamantes", "9 de Diamantes", "10 de Diamantes", 
        "Jota de Diamantes", "Reina de Diamantes", "Rey de Diamantes"
    ];

    shuffle($mazo); // Mezclar las cartas
    return array_slice($mazo, 0, 5); // Tomar las primeras 5 cartas
}

// Función para mostrar las cartas
function mostrarCartas($cartas) {
    echo "Tus cartas son:\n";
    foreach ($cartas as $carta) {
        echo $carta . "\n";
    }
}

// Función para evaluar la mano
function evaluarMano($cartas) {
    // Lógica básica de evaluación (simplificada)
    $valores = [];
    $palos = [];
    foreach ($cartas as $carta) {
        $partes = explode(" de ", $carta);
        $valores[] = $partes[0];
        $palos[] = $partes[1];
    }
    
    $valorContador = array_count_values($valores);
    $paloContador = array_count_values($palos);

    if (count($valorContador) == 5 && count($paloContador) == 1) {
        echo "¡Tienes un color!\n";
    } elseif (count($valorContador) == 2) {
        if (max($valorContador) == 4) {
            echo "¡Tienes un póker!\n";
        } else {
            echo "¡Tienes un full house!\n";
        }
    } elseif (count($valorContador) == 3) {
        if (max($valorContador) == 3) {
            echo "¡Tienes un trío!\n";
        } else {
            echo "¡Tienes dos pares!\n";
        }
    } elseif (count($valorContador) == 4) {
        echo "¡Tienes un par!\n";
    } else {
        echo "No tienes ninguna combinación especial.\n";
    }
}

// Ejecución del juego
$cartas = repartirCartas();
mostrarCartas($cartas);
evaluarMano($cartas);

?>