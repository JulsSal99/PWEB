<?php
function weekOfMonth($date) {
            // estrai le parti della data
            list($y, $m, $d) = explode('-', date('Y-m-d', strtotime($date)));
            // settimana corrente, min 1
            $w = 1;
            // per ogni giorno dall'inizio del mese
            for ($i = 1; $i<$d; ++$i) {
                // se quel giorno era domenica e non è il primo giorno del mese
                if (($i>1) && date('w', strtotime("$y-$m-$i")) == 0) {
                    // incrementa la settimana corrente
                    ++$w;
                }
            }
            return $w;
        }
?>