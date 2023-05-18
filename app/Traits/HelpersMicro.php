<?php

namespace App\Traits;

    trait HelpersMicro
    {

        public function encryptMicro($frase, $chave, $crypt)
        {
            $retorno = "";
            if ($crypt) {
                $string = $frase;
                $i = strlen($string) - 1;
                $j = strlen($chave);
                do {
                    $retorno .= $string[$i] ^ $chave[$i % $j];
                } while ($i--);
                return base64_encode(strrev($retorno));
            } else {
                $string = base64_decode($frase);
                $i = strlen($string) - 1;
                $j = strlen($chave);
                do {
                    $retorno .= $string[$i] ^ $chave[$i % $j];
                } while ($i--);
                return strrev($retorno);
            }
        }

    }
