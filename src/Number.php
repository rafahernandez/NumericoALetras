<?php


namespace Rafahernandez\NumericoALetras;


class Number
{
    public float $value;
    public int $integer;
    public int $decimal;
    protected array $static_values = [
        1   => 'UN',
        2   => 'DOS',
        3   => 'TRES',
        4   => 'CUATRO',
        5   => 'CINCO',
        6   => 'SEIS',
        7   => 'SIETE',
        8   => 'OCHO',
        9   => 'NUEVE',
        10  => 'DIEZ',
        11  => 'ONCE',
        12  => 'DOCE',
        13  => 'TRECE',
        14  => 'CATORCE',
        15  => 'QUINCE',
        16  => 'DIECISÉIS',
        17  => 'DIECISIETE',
        18  => 'DIECIOCHO',
        19  => 'DIECINUEVE',
        20  => 'VEINTE',
        21  => 'VEINTIUNO',
        22  => 'VEINTIDOS',
        23  => 'VEINTITRÉS',
        24  => 'VEINTICUATRO',
        25  => 'VEINTICINCO',
        26  => 'VEINTISEIS',
        27  => 'VEINTISIETE',
        28  => 'VEINTIOCHO',
        29  => 'VEINTINUEVE',
        30  => 'TREINTA',
        40  => 'CUARENTA',
        50  => 'CINCUENTA',
        60  => 'SESENTA',
        70  => 'SETENTA',
        80  => 'OCHENTA',
        90  => 'NOVENTA',
        100 => 'CIEN',
        200 => 'DOSCIENTOS',
        300 => 'TRESCIENTOS',
        400 => 'CUATROCIENTOS',
        500 => 'QUINIENTOS',
        600 => 'SEISCIENTOS',
        700 => 'SETECIENTOS',
        800 => 'OCHOCIENTOS',
        900 => 'NOVECIENTOS'
    ];

    public function __construct(float $value, int $decimal_precision = 2)
    {
        $this->value = $value;

        $as_string = number_format($value, $decimal_precision, '.', '');
        [$integer, $decimal] = explode('.', $as_string);

        $this->integer = $integer;
        $this->decimal = $decimal;
    }

    public function toString(): string
    {
        if (array_key_exists($this->integer, $this->static_values)) {
            return $this->static_values[$this->integer];
        }

        [$most_significant, $rest] = $this->splitMostSignificant();


        $next_significant = new Number($most_significant);
        if($most_significant >= 1_000 && $most_significant % 1_000 == 0){
            $truncated_amount = new Number($most_significant/ 1_000);
            $as_string = $truncated_amount->toString();
        }else{
            $as_string = $next_significant->toString();
        }

        if((int) $rest){
            $as_string .= $next_significant->getConnector() . (new Number($rest))->toString();
        }
        return $as_string;
    }

    public function splitMostSignificant(): array
    {
        $strlen = strlen($this->integer);
        if ($strlen == 1) {
            return [$this->integer, ''];
        }
        $take = 1;
        $pad = $strlen;
        if($this->integer >= 10_000){
            $take++;
            $pad--;
        }

        $most_significant = substr($this->integer, 0, $take);
        return [
            $most_significant * (str_pad('1', $pad, 0, STR_PAD_RIGHT)),
            substr($this->integer, $take, $strlen)
        ];
    }

    public  function getConnector(): string
    {
        if($this->integer == 100){
            return 'TO ';
        }

        if($this->integer < 100 && $this->integer >=30 && $this->integer % 10 == 0){
            return ' Y ';
        }

        if($this->integer % 1_000 == 0 && $this->integer < 1_000_000){
            return ' MIL ';
        }

        return ' ';
    }
}
