<?php

// handler of the user profile test page
$user_prtest_questions = Array();

$user_prtest_questions["favorite-categories"] = Array(
  'title' => '¿Cuáles son tu categorías de juegos favoritas?',
  'type' => 'multiple',
  'answers' => Array(
      Array(6, "Tragamonedas"),
      Array(7, "Bingo"),
      Array(0, "Ruleta"),
      Array(0, "Backjack"),
      Array(0, "Póker"),
      Array(0, "Casino en vivo"),
      Array(0, "Apuestas deportivas"),
      Array(0, "Baccarat"),
      Array(57, "Slingo"),
      Array(0, "Otros")
  )
);

$user_prtest_questions["hours-free-games"] = Array(
  'title' => '¿Cuántas hora por dia dirías que sueles jugar versiones gratuitas?',
  'type' => 'single',
  'answers' => Array(
    Array("0", "0 (cero)"),
    Array("1hr_menos", "Menos de 1 hora"),
    Array("1hr_mas", "Más de 1 hora"),
    Array("3hr_mas", "Más de 3 horas")
  )
);

$user_prtest_questions["your-age"] = Array(
  'title' => '¿Qué edad tienes?',
  'type' => 'number',
  'answers' => Array(__("18 años"))
);


$user_prtest_questions["hours-money-games"] = Array(
  'title' => '¿Cuántas horas por dia dirías que sueles jugar por dinero real?',
  'type' => 'single',
  'answers' => Array(
    Array("0", "0 (cero)"),
    Array("1hr_menos", "Menos de 1 hora"),
    Array("1hr_mas", "Más de 1 hora"),
    Array("3hr_mas", "Más de 3 horas")
  )
);

$user_prtest_questions["interested-in-bonuses"] = Array(
  'title' => '¿Te interesan los bonos y códigos promocionales?',
  'type' => 'single',
  'answers' => Array(
    Array("yes", __("Yes", "aipim")),
    Array("no", __("No", "aipim"))
  )
);

$user_prtest_questions["worried-about-being-known-as-player"] = Array(
  'title' => '¿Has intentando ocultar a tu familia que juegas online?',
  'type' => 'single',
  'answers' => Array(
    Array("yes", __("Yes", "aipim")),
    Array("no", __("No", "aipim"))
  )
);

$user_prtest_questions["worried-about-being-known-as-player"] = Array(
  'title' => '¿Has intentando ocultar a tu familia o amigos que apuestas online?',
  'type' => 'single',
  'answers' => Array(
    Array("yes", __("Yes", "aipim")),
    Array("no", __("No", "aipim"))
  )
);

$user_prtest_questions["have-borrowed-money"] = Array(
  'title' => '¿Has pedido dinero prestado para apostar online?',
  'type' => 'single',
  'answers' => Array(
    Array("yes", __("Yes", "aipim")),
    Array("no", __("No", "aipim"))
  )
);

$user_prtest_questions["larger-amount-money-spent"] = Array(
  'title' => '¿De cuánto es la suma mas grande que has gastado apostando en un dia?',
  'type' => 'number',
  'answers' => Array(__("$"))
);


$user_prtest_questions["interested-new-games"] = Array(
  'title' => '¿Te interesan los juegos nuevos o los clásicos?',
  'type' => 'single',
  'answers' => Array(
    Array("new", __("I'm interested in new games", "aipim")),
    Array("classics", __("I'm interested in classic games", "aipim"))
  )
);

// this should be a futuro conditional question
$user_prtest_questions["interested-in-playing-for-money-in-futuro"] = Array(
  'title' => 'Si todavía no lo has hecho, ¿dirías que estás interesado en apostar por dinero a futuro?',
  'type' => 'single',
  'answers' => Array(
    Array("yes", __("Yes", "aipim")),
    Array("no", __("No", "aipim"))
  )
);

$user_prtest_questions["volatility-choice"] = Array(
  'title' => '¿Te gusta ganar pequeñas sumas pero muy frecuentemente o prefieres que los premios demoren y sean mas altos?',
  'type' => 'single',
  'answers' => Array(
    Array("like-frecuent-prizes", __("I am interested in winning little and often", "aipim")),
    Array("like-high-prizes", __("I'm interested in big prizes", "aipim"))
  )
);

$user_prtest_questions["single-or-multiplayer"] = Array(
  'title' => '¿Prefieres jugar solo/a o vincularte con otros jugadores?',
  'type' => 'single',
  'answers' => Array(
    Array("like-frecuent-prizes", __("I prefer to play alone", "aipim")),
    Array("like-high-prizes", __("I prefer to play with other people", "aipim"))
  )
);

$user_prtest_questions["have-you-tried-quitting"] = Array(
  'title' => '¿Has intentando alguna vez dejar de jugar o jugar menos?',
  'type' => 'single',
  'answers' => Array(
    Array("yes", __("Yes", "aipim")),
    Array("no", __("No", "aipim"))
  )
);

$user_prtest_questions["interested-in-helping-the-community"] = Array(
  'title' => '¿Te interesa colaborar con otros jugadores contando tus experiencias como jugador?',
  'type' => 'single',
  'answers' => Array(
    Array("yes", __("Yes", "aipim")),
    Array("no", __("No", "aipim"))
  )
);

$user_prtest_questions["use-survey-for-personalization"] = Array(
  'title' => '¿Quieres que personalicemos lo que ves en el sitio en base a esta encuesta?',
  'type' => 'single',
  'answers' => Array(
    Array("yes", __("Yes", "aipim")),
    Array("no", __("No", "aipim"))
  )
);


?>
